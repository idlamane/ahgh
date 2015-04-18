<?php

namespace Amb\GlobalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\GlobalBundle\Entity\Scann;
use Amb\GlobalBundle\Form\ScannType;
use JMS\SecurityExtraBundle\Annotation\Secure;


class ScannController extends Controller
{


    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_scannAction($type, $format=null)
    {
        $rep_scann = $this->getDoctrine()
                         ->getManager()
                         ->getRepository('AmbGlobalBundle:Scann');
        if($type=="adhs"){
            $scanns = $rep_scann->ListScann($type)->getQuery()->getResult();
            return $this->render('AmbGlobalBundle:Scann:list_scann_adhs.html.twig', array(
                'scanns' => $scanns,
                ));
        }else{
            $scanns = $rep_scann->ListScann($type)->getQuery()->getResult();
            return $this->render('AmbGlobalBundle:Scann:list_scann_frs.html.twig', array(
                'scanns' => $scanns,
                ));
        }

    }


    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function add_scannAction($type, $id)
    {
        if($type=="adhs"){
            $rep_adhs = $this->getDoctrine()
                             ->getManager()
                             ->getRepository('AmbAdherentBundle:Adhesion');
            $adhesion = $rep_adhs->find($id);

            if($adhesion == null)
            {
                throw $this->createNotFoundException('Adhesion[id='.$id.'] inexistant.');
            }
            $scann = new Scann;
            $form = $this->createForm(new ScannType($type), $scann);

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();
                    $scann->setAdherent($adhesion->getAdherent());
                    $scann->setAdhesion($adhesion);
                    $scann->setMatricule($adhesion->getMatricule());
                    $em->persist($scann);
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('add', 'Ajouter scann ID :'.$scann->getId(), $scann->getId(), '', 'AmbGlobalBundle:Scann');

                    return $this->redirect( $this->generateUrl('ambscann_list', array(
                        'type' => 'adhs'
                        )) 
                    );
                }
            } 
            return $this->render('AmbGlobalBundle:Scann:add_scann.html.twig', array(
            'form' => $form->createView(),
            'adhesion' => $adhesion,
            ));

        }else{

            $rep_frs = $this->getDoctrine()
                             ->getManager()
                             ->getRepository('AmbDebitBundle:Fournisseur');
            $fournisseur = $rep_frs->find($id);

            if($fournisseur == null)
            {
                throw $this->createNotFoundException('Fournisseur[id='.$id.'] inexistant.');
            }
            $scann = new Scann;

            $ambexceldb = $this->container->get('amb_credit.ambexceldb');
            $scan_frs = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'scan_frs');
            $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
            $imm = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');

            $form = $this->createForm(new ScannType($type, $scan_frs, $imm_group, $imm), $scann);

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();
                    $scann->setFournisseur($fournisseur);
                    $em->persist($scann);
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('add', 'Ajouter scann ID :'.$scann->getId(), $scann->getId(), '', 'AmbGlobalBundle:Scann');

                    return $this->redirect( $this->generateUrl('ambscann_list', array(
                        'type' => 'frs'
                        )) 
                    );
                }
            } 
            return $this->render('AmbGlobalBundle:Scann:add_scann.html.twig', array(
            'form' => $form->createView(),
            'fournisseur' => $fournisseur,
            ));
        }
    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function delete_scannAction($type, $id)
    {
        $rep_scan = $this->getDoctrine()
                                        ->getRepository('AmbGlobalBundle:Scann');
        $scann = $rep_scan->find($id);
        if($scann != null)
        {  
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($scann);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', 'supprimer scan ID :'.$id, $id,'', 'AmbGlobalBundle:Scann');
            return $this->redirect( $this->generateUrl('ambscann_list', array(
                        'type' => $type
                        )) 
                    );
        }
        if($adherent === null)
        {
            throw $this->createNotFoundException('Scan[N° '.$id.'] inexistant.');
        }

    }

    public function download_scanAction($filename)
    {
        $request = $this->get('request');
        $path = $this->get('kernel')->getRootDir(). "/../web/uploads/scann/";
        $content = file_get_contents($path.$filename);

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

        $response->setContent($content);
        return $response;
    }
}