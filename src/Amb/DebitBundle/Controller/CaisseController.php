<?php

namespace Amb\DebitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\DebitBundle\Entity\Caisse;
use Amb\DebitBundle\Entity\Depense;
use Amb\DebitBundle\Form\CaisseType;
use Amb\DebitBundle\Form\CaisseFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;

class CaisseController extends Controller
{
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function add_caisseAction()
    {
        $caisse = new caisse;

        $form = $this->createForm(new caisseType, $caisse);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();                
                $em->persist($caisse);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter caisse ID :'.$caisse->getId(), $caisse->getId(), '', 'AmbDebitBundle:Caisse');

                return $this->redirect( $this->generateUrl('ambcaisse_list') );
            }
        } 
        return $this->render('AmbDebitBundle:Caisse:add_caisse.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function update_caisseAction($id)
    {
    	$repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Caisse');
    	$caisse = $repository->find($id);
    	if($caisse != null){
	        $form = $this->createForm(new CaisseType, $caisse);
	        $request = $this->get('request');
	        if( $request->getMethod() == 'POST' )
	        {
	            $form->bind($request);
	            if( $form->isValid() )
	            {   
	                $em = $this->getDoctrine()->getEntityManager();

                    $uow = $em->getUnitOfWork();
                    $uow->computeChangeSets();
                    $changeset = $uow->getEntityChangeSet($caisse);
	                $em->persist($caisse);
	                $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('update', 'modification du caisse ID :'.$id, $id, $changeset, 'AmbDebitBundle:Caisse');

	                return $this->redirect( $this->generateUrl('ambcaisse_list') );
	            }
	        } 
	        return $this->render('AmbDebitBundle:Caisse:update_caisse.html.twig', array(
	        'form' => $form->createView(),
	        ));
        }
        return $this->redirect( $this->generateUrl('ambcaisse_list') );
    }
    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function delete_caisseAction($id)
    {
    	$repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Caisse');
    	$caisse = $repository->find($id);
    	if($caisse != null){
	        
            $description = 'supprimer caisse ID :'.$id.'
                            , libelle :'.$caisse->getLibelle().'
                            , Montant : '.$caisse->getMontant().'
                            ';
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($caisse);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', $description, $id,'', 'AmbDebitBundle:Caisse');
	        return $this->redirect( $this->generateUrl('ambcaisse_list') );
        }
        if($caisse === null)
        {
            throw $this->createNotFoundException('Caisse[id='.$id.'] inexistant.');
        }
    }
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function list_caisseAction($print = NULL)
    {
    	$caisse_repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Caisse');

    	$depense_repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Depense');
        $somme_encaissement = $depense_repository->getSumEncaissementCaisseTotal();
        $somme_decaissement = $caisse_repository->getSumDecaissementCaisseTotal();
        $solde_caisse = $somme_encaissement-$somme_decaissement; 


    	$form = $this->get('form.factory')->create(new CaisseFilterType());

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $filterBuilder = $this->getDoctrine()
                           ->getManager()
		                   ->getRepository('AmbDebitBundle:Caisse')
		                   ->createQueryBuilder('e');
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $qb = $filterBuilder->orderBy('e.date_operation', 'DESC');

            //$caisses = $qb->getQuery()->getResult();

            $date_debut = $form->get('date_debut')->getData()->format('d-m-Y');
            $date_fin = $form->get('date_fin')->getData()->format('d-m-Y');
            $justif = $form->get('justif')->getData();
            $typedepense = $form->get('typedepense')->getData();
            if($typedepense != null) $typedepense_id = $typedepense->getId();else $typedepense_id = null;
            $mot_cle = $form->get('mot_cle')->getData();

            $decaisse = $caisse_repository->SumDecaissementCaisse(new \Datetime($date_debut), new \Datetime($date_fin), $typedepense_id , $justif , $mot_cle );
            $encaisse = $caisse_repository->SumEncaissementCaisse(new \Datetime($date_debut), new \Datetime($date_fin), $typedepense_id , $justif , $mot_cle );
            $soldeinitial = $caisse_repository->soldeInitial(new \Datetime($date_debut), new \Datetime($date_fin), $typedepense_id , $justif , $mot_cle );
            $caisses = $caisse_repository->JournalCaisse(new \Datetime($date_debut), new \Datetime($date_fin), $typedepense_id, $justif , $mot_cle );

            if ($print == 'print') {
            	$html = $this->render('AmbDebitBundle:Caisse:list_caisse.pdf.twig', array(
                        'date_debut' => $form->get('date_debut')->getData()->format('d/m/Y'),
                        'date_fin' => $form->get('date_fin')->getData()->format('d/m/Y'),
                        'caisses' => $caisses,
                        'decaisse' => $decaisse,
                        'encaisse' => $encaisse,
                        'soldeinitial' => $soldeinitial,
                        'solde_caisse' => $solde_caisse
                    ));
		        
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('ListDepense_'.$date_debut.'_'.$date_fin.'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
            	return $this->render('AmbDebitBundle:Caisse:list_caisse.html.twig', array(
            	'form' => $form->createView(), 
            	'caisses' => $caisses,
                'decaisse' => $decaisse,
                'encaisse' => $encaisse,
                'solde_caisse' => $solde_caisse));
            }
        }

            $decaisse = $caisse_repository->SumDecaissementCaisse(new \Datetime('01-01-'.date('Y')), new \Datetime('31-12-'.date('Y')));
            $encaisse = $caisse_repository->SumEncaissementCaisse(new \Datetime('01-01-'.date('Y')), new \Datetime('31-12-'.date('Y')));
            $caisses=$caisse_repository->JournalCaisse(new \Datetime('01-01-'.date('Y')), new \Datetime('31-12-'.date('Y')));
            //$test = var_dump($caisses);
            //$caisses = $caisse_repository->ListCaisseOrderByDate();
        	return $this->render('AmbDebitBundle:Caisse:list_caisse.html.twig', array(
        	'form' => $form->createView(), 
            'decaisse' => $decaisse,
            'encaisse' => $encaisse,
            'caisses' => $caisses,
            'solde_caisse' => $solde_caisse));
        
        
    }
}