<?php

namespace Amb\ContratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\ContratBundle\Entity\Contrat;
use Amb\ContratBundle\Form\ContratType;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ContratController extends Controller
{
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function contratsbyfrsAction()
    {
            
            $id= $this->get('request')->request->get('id');;
            $repository = $this->getDoctrine()
                               ->getManager()
                               ->getRepository('AmbContratBundle:Contrat');
            $contrats = $repository->findBy(array('fournisseur' => 2));                   
            $list ='';
            foreach ($contrats as $contrat) {
                $list .= '<option value="'.$contrat->getId().'">'.$contrat->getReference().'</option>';
            }
            return new Response($id, 200);
    }

    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function list_contratAction($format)
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbContratBundle:Contrat');
        $contrats = $repository->findcontratactif();   
        $total_reglements = $repository->SumReglementConventions();   
        $total_contrats = $repository->SumMontantConventions();   
        //var_dump($contrats);                
        $page = 10;
        // On ne sait pas combien de pages il y a, mais on sait qu'une page
        // doit être supérieure ou égale à 1.
        if( $page < 1 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
        }
        if ($format == 'pdf') {
            $html = $this->render('AmbContratBundle:Contrat:list_contrat.pdf.twig', array(
                    'contrats' => $contrats, 
                    'total_reglements' => $total_reglements, 
                    'total_contrats' => $total_contrats, 
                    'titre' => 'Liste des contrats & engagements'
                    ));
            $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('listconvention.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            return $this->render('AmbContratBundle:Contrat:list_contrat.html.twig', array(
                    'contrats' => $contrats, 
                    'total_reglements' => $total_reglements, 
                    'total_contrats' => $total_contrats, 
                    'titre' => 'Liste des contrats & engagements'
                    ));
        }
    }


    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function list_resiliationAction()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbContratBundle:Contrat');
        $contrats = $repository->findcontratresilier();                   
        $page = 10;
        // On ne sait pas combien de pages il y a, mais on sait qu'une page
        // doit être supérieure ou égale à 1.
        if( $page < 1 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
        }
        return $this->render('AmbContratBundle:Contrat:list_resiliation.html.twig', array('contrats' => $contrats, 'titre' => 'Liste des résiliations'));
    }

    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function add_contratAction()
    {
        $contrat = new Contrat;

        $form = $this->createForm(new ContratType(), $contrat);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($contrat);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajout du contrat ID :'.$contrat->getId(), $contrat->getId(), '', 'AmbContratBundle:Contrat');

                return $this->redirect( $this->generateUrl('ambcontrat_list') );
            }
        } 
            return $this->render('AmbContratBundle:Contrat:add_contrat.html.twig', array(
            'form' => $form->createView(),
            ));

    }


    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function update_contratAction($id)
    {
        $contrat_repository = $this->getDoctrine()
                                    ->getRepository('AmbContratBundle:Contrat');
        $contrat = $contrat_repository->find($id);

        $form = $this->createForm(new ContratType(), $contrat);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $em = $this->getDoctrine()->getEntityManager();
				$uow = $em->getUnitOfWork();
				$uow->computeChangeSets();
				$changeset = $uow->getEntityChangeSet($contrat);
                $em->persist($contrat);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modification du contrat ID :'.$id, $id, $changeset, 'AmbContratBundle:Contrat');
                return $this->redirect( $this->generateUrl('ambcontrat_list') );
            }
        }
        if($contrat == null)
        {
            return $this->redirect( $this->generateUrl('ambcontrat_list') );
        }
        return $this->render('AmbContratBundle:Contrat:update_contrat.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_contratAction($id)
    {
        $contrat_repository = $this->getDoctrine()
                                    ->getRepository('AmbContratBundle:Contrat');
        $contrat = $contrat_repository->find($id);
        if($contrat != null)
        {  
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($contrat);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', 'supprimer contrat ID :'.$id, $id,'', 'AmbContratBundle:Contrat');
            return $this->redirect( $this->generateUrl('ambcontrat_list'));
        }
        if($contrat === null)
        {
            throw $this->createNotFoundException('Contrat[N° '.$id.'] inexistant.');
        }

    }


    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function consult_contratAction($id, $format)
    {
        $contrat_rep = $this->getDoctrine()->getrepository('AmbContratBundle:Contrat');
        $contrat = $contrat_rep->find($id);
        if($contrat == null)
        {
            throw $this->createNotFoundException('Contrat[id='.$id.'] inexistant.');
        }
            
        $depense_rep = $this->getDoctrine()->getrepository('AmbDebitBundle:Depense');
        $total_reglement = $depense_rep->TotalReglementContrat($id);
        $reglements = $depense_rep->findBy(array('fournisseur' => $contrat->getFournisseur()->getId(), 'contrat' => $contrat->getId()));
        
        if ($format == 'pdf') {
            $html = $this->render('AmbContratBundle:Contrat:consult_contrat.pdf.twig', array(
                'contrat' => $contrat,
                'reglements' => $reglements,
                'total_reglement' => $total_reglement,
                ));
            $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('situation_contrat'.$contrat->getReference().'.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            return $this->render('AmbContratBundle:Contrat:consult_contrat.html.twig', array(
                'contrat' => $contrat,
                'reglements' => $reglements,
                'total_reglement' => $total_reglement,
                ));
        }
        
    }


    //grand livre des contrats
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function gl_contratAction($format)
    {
        $contrat_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbContratBundle:Contrat');
        $depense_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Depense');
        $frs_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Fournisseur');
        $reglements = $depense_rep->createQueryBuilder('d')
                                ->where('d.contrat IS NOT NULL')
                                ->getQuery()
                                ->getResult();
        $fournisseurs = $frs_rep->createQueryBuilder('f')
                                ->where('f.is_intervenant IS NOT NULL')
                                ->getQuery()
                                ->getResult();
        $contrats = $contrat_rep->findcontratactif();   
        $total_reglements = $contrat_rep->SumReglementConventions();   
        $total_contrats = $contrat_rep->SumMontantConventions();   
        //var_dump($contrats);   

        if ($format == 'pdf') {
            $html = $this->render('AmbContratBundle:Contrat:gl_contrat.pdf.twig', array(
                    'fournisseurs' => $fournisseurs,
                    'titre' => 'Situation globale des intervenants'
                    ));
            $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('listconvention.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            return $this->render('AmbContratBundle:Contrat:list_contrat.html.twig', array(
                    'contrats' => $contrats, 
                    'total_reglements' => $total_reglements, 
                    'total_contrats' => $total_contrats, 
                    'fournisseurs' => $fournisseurs,
                    'titre' => 'Liste des contrats & engagements'
                    ));
        }
    }

}
