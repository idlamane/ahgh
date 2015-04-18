<?php
namespace Amb\AdherentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\AdherentBundle\Entity\Adherent;
use Amb\AdherentBundle\Form\AdherentType;
use Amb\AdherentBundle\Form\AdherentFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Doctrine\Common\Persistence\ObjectManager;
use Amb\UserBundle\Entity\User;


use PHPExcel;
use PHPExcel_IOFactory;

class AdherentController extends Controller
{
   /**
   * @Secure(roles="ROLE_USER")
   */
    public function indexAction()
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Adherent');


            $form = $this->get('form.factory')->create(new AdherentFilterType());
            

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                $form->get('statut')->getData();
                $adherents = $repository->FilterAdherent($form->get('statut')->getData());  
                
                return $this->render('AmbAdherentBundle:Adherent:index.html.twig', array(
                    'adherents' => $adherents,
                    'form' => $form->createView()
                    ));

            }                       
        //$adherents = $repository->findAll();    
        $adherents = $repository->FilterAdherent();              
        $page = 10;
        // On ne sait pas combien de pages il y a, mais on sait qu'une page
        // doit être supérieure ou égale à 1.
        if( $page < 1 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
        }
        return $this->render('AmbAdherentBundle:Adherent:index.html.twig', array(
            'adherents' => $adherents,
            'form' => $form->createView()
            ));
    }
    /**
    * @Secure(roles="ROLE_USER")
    */
    public function contactAction()
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Adherent');
        $adherents = $repository->findAll();   
        return $this->render('AmbAdherentBundle:Adherent:contact.html.twig', array('adherents' => $adherents));
    }
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function ajouterAction()
    {
        $adherent = new Adherent;
        $adherent->setDateInscription(new \Datetime());

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $civilite = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'civilite');
        $etat_civile = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etat_civile');

        $form = $this->createForm(new AdherentType($civilite, $etat_civile), $adherent);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($adherent);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter adherent ID :'.$adherent->getId(), $adherent->getId(), '', 'AmbAdherentBundle:Adherent');

                return $this->redirect( $this->generateUrl('ambadherent_accueil') );
            }
        } 
        return $this->render('AmbAdherentBundle:Adherent:ajouter.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function voirAction($id, $format)
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Adherent');


        $adherent = $repository->find($id);

        if($adherent === null)
        {
            throw $this->createNotFoundException('Adherent[id='.$id.'] inexistant.');
        }    
        $repository_encaissement = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbCreditBundle:Encaissement');
        $repository_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');
        $adhesions = $repository_adhesion->findDetailByAdherent($adherent->getId());

        $appts = $adherent->getAdhesions();
        if ($format == 'pdf') {
            $html = $this->render('AmbAdherentBundle:Adherent:voir.pdf.twig', array(
            'adherent' => $adherent,
            'adhesions' => $adhesions
            ));
            $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('my-document-name.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            return $this->render('AmbAdherentBundle:Adherent:voir.html.twig', array(
                'adherent' => $adherent,
                'adhesions' => $adhesions,
                'appts' => $appts
            ));
        }
    }


    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function modifierAction($id)
    {
        $adherent_repository = $this->getDoctrine()
                                    ->getRepository('AmbAdherentBundle:Adherent');
        $adherent = $adherent_repository->find($id);
        //$avant=$adherent_repository->getAdherentForLog($adherent);
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $civilite = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'civilite');
        $etat_civile = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etat_civile');

        $form = $this->createForm(new AdherentType($civilite, $etat_civile), $adherent);

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $em = $this->getDoctrine()->getEntityManager();
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($adherent);
                $em->persist($adherent);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier adherent ID :'.$id, $id, $changeset, 'AmbAdherentBundle:Adherent');


                // Create the logger
                $logger = new Logger('my_logger');
                // Now add some handlers
                $logger->pushHandler(new StreamHandler(__DIR__.'/log/adherent/my_app.log', Logger::DEBUG));
                $logger->pushHandler(new FirePHPHandler());

                // You can now use your logger
                $logger->addInfo('Adding a new user', array('username' => 'Seldaek'));
                return $this->redirect( $this->generateUrl('ambadherent_accueil') );
            }
        }
        if($adherent == null)
        {
            return $this->redirect( $this->generateUrl('ambadherent_accueil') );
        }
        return $this->render('AmbAdherentBundle:Adherent:modifier.html.twig', array(
        'form' => $form->createView(),
        ));
    }


    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_adherentAction($id)
    {
        $adherent_repository = $this->getDoctrine()
                                        ->getRepository('AmbAdherentBundle:Adherent');
        $adherent = $adherent_repository->find($id);
        if($adherent != null)
        {  
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($adherent);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', 'supprimer adherent ID :'.$id, $id,'', 'AmbAdherentBundle:Adherent');
            return $this->redirect( $this->generateUrl('ambadherent_accueil'));
        }
        if($adherent === null)
        {
            throw $this->createNotFoundException('Adhérent[N° '.$id.'] inexistant.');
        }

    }

}