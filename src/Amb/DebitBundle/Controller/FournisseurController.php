<?php

namespace Amb\DebitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Amb\DebitBundle\Entity\Fournisseur;
use Amb\DebitBundle\Form\FournisseurType;
use Symfony\Component\Httpfoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;

class FournisseurController extends Controller
{
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function add_fournisseurAction()
    {
        $fournisseur = new Fournisseur;
        //$adherent->setDateInscription(new \Datetime());

        $form = $this->createForm(new FournisseurType, $fournisseur);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($fournisseur);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter fournisseur ID :'.$fournisseur->getId(), $fournisseur->getId(), '', 'AmbDebitBundle:Fournisseur');
                return $this->redirect( $this->generateUrl('ambfournisseur_listfournisseur') );
            }
        } 
        return $this->render('AmbDebitBundle:Fournisseur:add_fournisseur.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    public function is_intervenantAction()
    {
        $id= $this->get('request')->request->get('id');
        $repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Fournisseur');
        $fournisseur = $repository->find($id);
        if($fournisseur != null){
            if ($fournisseur->getIsIntervenant() == 1) {
                $return = $this->generateUrl('ambdepense_ajouter', array(
                            'type' => 'amortissement',
                            'frs' => $id,
                            ));
                return new Response($return, 200);
            }
        }
        return new Response('false', 200);
    }
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function update_fournisseurAction($id)
    {
    	$repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Fournisseur');
    	$fournisseur = $repository->find($id);
    	if($fournisseur != null){
	        $form = $this->createForm(new FournisseurType, $fournisseur);
	        $request = $this->get('request');
	        if( $request->getMethod() == 'POST' )
	        {
	            $form->bind($request);
	            if( $form->isValid() )
	            {   
	                $em = $this->getDoctrine()->getEntityManager();
                    $uow = $em->getUnitOfWork();
                    $uow->computeChangeSets();
                    $changeset = $uow->getEntityChangeSet($fournisseur);
	                $em->persist($fournisseur);
	                $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('update', 'modifier fournisseur ID :'.$id, $id, $changeset, 'AmbDebitBundle:Fournisseur');
	                return $this->redirect( $this->generateUrl('ambfournisseur_listfournisseur') );
	            }
	        } 
	        return $this->render('AmbDebitBundle:Fournisseur:update_fournisseur.html.twig', array(
	        'form' => $form->createView(),
	        ));
        }
        return $this->redirect( $this->generateUrl('ambfournisseur_listfournisseur') );
    }
    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_fournisseurAction($id)
    {
    	$repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Fournisseur');
    	$fournisseur = $repository->find($id);
    	if($fournisseur != null){
	        
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($fournisseur);
            $em->flush();

	        return $this->redirect( $this->generateUrl('ambfournisseur_listfournisseur') );
        }
        if($fournisseur === null)
        {
            throw $this->createNotFoundException('Fournisseur[id='.$id.'] inexistant.');
        }
    }

    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function consult_fournisseurAction($id)
    {
    	$repository = $this->getDoctrine()->getrepository('AmbDebitBundle:Fournisseur');
    	$fournisseur = $repository->find($id);
    	if($fournisseur != null){
	        
		    return $this->render('AmbDebitBundle:Fournisseur:consult_fournisseur.html.twig', array(
		    'fournisseur' => $fournisseur,
		    ));
        }
        if($fournisseur === null)
        {
            throw $this->createNotFoundException('Fournisseur[id='.$id.'] inexistant.');
        }
    }
    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_fournisseurAction()
    {
    	$repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Fournisseur');
        $fournisseurs = $repository->findAll();

        return $this->render('AmbDebitBundle:Fournisseur:list_fournisseur.html.twig', array(
                        'fournisseurs' => $fournisseurs
                    ));
    }
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function list_intervenantAction()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Fournisseur');
        $fournisseurs = $repository->findby(array('is_intervenant' => true));

        return $this->render('AmbDebitBundle:Fournisseur:list_intervenant.html.twig', array(
                        'fournisseurs' => $fournisseurs
                    ));
    }
}
