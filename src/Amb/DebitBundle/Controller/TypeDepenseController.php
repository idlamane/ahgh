<?php

namespace Amb\DebitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\DebitBundle\Entity\TypeDepense;
use Amb\DebitBundle\Form\TypeDepenseType;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PHPExcel;
use PHPExcel_IOFactory;

class TypeDepenseController extends Controller
{
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function list_typedepenseAction()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:TypeDepense');
        $typesdepenses = $repository->findAll();

        return $this->render('AmbDebitBundle:TypeDepense:list_typedepense.html.twig', array('typesdepenses' => $typesdepenses));
    }
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function add_typedepenseAction()
    {
        $typedepense = new TypeDepense;
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $compte_depense = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'compte_depense');

        $form = $this->createForm(new TypeDepenseType($compte_depense), $typedepense);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typedepense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter typedepense ID :'.$typedepense->getId(), $typedepense->getId(), '', 'AmbDebitBundle:TypeDepense');
                return $this->redirect( $this->generateUrl('ambtypedepense_accueil') );
            }
        } 
        return $this->render('AmbDebitBundle:TypeDepense:add_typedepense.html.twig', array(
        'form' => $form->createView(),
        ));

    }

    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function update_typedepenseAction($id)
    {
        $typedepense = $this->getDoctrine()
                           ->getRepository('AmbDebitBundle:TypeDepense')
                           ->find($id);
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $compte_depense = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'compte_depense');

        $form = $this->createForm(new TypeDepenseType($compte_depense), $typedepense);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $em = $this->getDoctrine()->getEntityManager();
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($typedepense);
                $em->persist($typedepense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier typedepense ID :'.$id, $id, $changeset, 'AmbDebitBundle:TypeDepense');
                return $this->redirect( $this->generateUrl('ambtypedepense_accueil') );
            }
        }
        if($typedepense == null)
        {
            return $this->redirect( $this->generateUrl('ambtypedepense_accueil') );
        }
        return $this->render('AmbDebitBundle:TypeDepense:update_typedepense.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_typedepenseAction($id)
    {
        $typedepense_repository = $this->getDoctrine()
                                       ->getRepository('AmbDebitBundle:TypeDepense');
        $typedepense = $typedepense_repository->find($id);
        if($typedepense != null)
        {  
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($typedepense);
            $em->flush();
            return $this->redirect( $this->generateUrl('ambtypedepense_accueil'));
        }
        if($typedepense === null)
        {
            throw $this->createNotFoundException('Type de dépense [N° '.$id.'] inexistant.');
        }

    }
}