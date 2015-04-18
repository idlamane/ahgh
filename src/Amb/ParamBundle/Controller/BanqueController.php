<?php

namespace Amb\ParamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\ParamBundle\Entity\Banque;
use Amb\ParamBundle\Form\BanqueType;
use JMS\SecurityExtraBundle\Annotation\Secure;

class BanqueController extends Controller
{
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbParamBundle:Banque');
        $banques = $repository->findAll();

        return $this->render('AmbParamBundle:Banque:list_banque.html.twig', array('banques' => $banques));
    }
    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function detail_banqueAction($id)
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbParamBundle:Banque');


        $banque = $repository->find($id);

        if($banque === null)
        {
            throw $this->createNotFoundException('Compte Bancaire [id='.$id.'] inexistant.');
        } 
        $html = $this->render('AmbParamBundle:Banque:detail_banque.html.twig', array(
            'banque' => $banque
        ));
 
        return $html;
    }
    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function add_banqueAction()
    {
        $banque = new Banque;

        $form = $this->createForm(new BanqueType(), $banque);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($banque);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter banque ID :'.$banque->getId(), $banque->getId(), '', 'AmbParamBundle:Banque');
                return $this->redirect( $this->generateUrl('ambbanque_accueil') );
            }
        } 
        return $this->render('AmbParamBundle:Banque:add_banque.html.twig', array(
        'form' => $form->createView(),
        ));

    }

    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function update_banqueAction($id)
    {
        $banque = $this->getDoctrine()
                           ->getRepository('AmbParamBundle:Banque')
                           ->find($id);

        $form = $this->createForm(new BanqueType(), $banque);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $em = $this->getDoctrine()->getEntityManager();
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($banque);
                $em->persist($banque);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier banque ID :'.$id, $id, $changeset, 'AmbParamBundle:Banque');
                return $this->redirect( $this->generateUrl('ambbanque_accueil') );
            }
        }
        if($banque == null)
        {
            return $this->redirect( $this->generateUrl('ambbanque_accueil') );
        }
        return $this->render('AmbParamBundle:Banque:update_banque.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_banqueAction($id)
    {
        $banque_repository = $this->getDoctrine()
                                        ->getRepository('AmbParamBundle:Banque');
        $banque = $banque_repository->find($id);
        if($banque != null)
        {  
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($banque);
            $em->flush();
            return $this->redirect( $this->generateUrl('ambbanque_accueil'));
        }
        if($banque === null)
        {
            throw $this->createNotFoundException('Compte[N° '.$id.'] inexistant.');
        }

    }
}