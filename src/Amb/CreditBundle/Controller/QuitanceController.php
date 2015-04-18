<?php

namespace Amb\CreditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\CreditBundle\Entity\Encaissement;
use Amb\CreditBundle\Entity\Quitance;
use Amb\AdherentBundle\Entity\Adherent;
use JMS\SecurityExtraBundle\Annotation\Secure;


class QuitanceController extends Controller
{
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function print_quitanceAction($id)
    {
        $quitance = $this->getDoctrine()
                           ->getRepository('AmbCreditBundle:Quitance')
                           ->find($id);

        if($quitance == null)
        {
            throw $this->createNotFoundException('Quitance inexistant.');
        }
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->findBy(array('quitance' => $quitance->getId()));
        if (count($encaissement) > 1) {
            $encaissement = $encaissement_repository->encaissement_groupby($quitance->getId());
        }
        $converter = $this->container->get('amb_credit.chiffrenlettre');
        $enlettre = $converter->ConvNumberLetter($quitance->getMontant(),3,0);
        $html = $this->render('AmbCreditBundle:Quitance:quitance.pdf.twig', array(
                    'quitance' => $quitance,
                    'encaissement' => $encaissement,
                    'enlettre' => $enlettre,
                ));
                
        $html2pdf = new \Html2Pdf_Html2Pdf('L','A5','fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($html->getContent());
        $html = $html2pdf->Output('Qt_'.$quitance->getId().'.pdf');
        $response = new Response();
        $response->clearHttpHeaders();
        $response->setContent(file_get_contents($html));
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename='. $html); 
        return $response;
    }
        
    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_quitanceAction()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbCreditBundle:Quitance');
        $quitances = $repository->findAll();

        return $this->render('AmbCreditBundle:Quitance:list_quitance.html.twig', array('quitances' => $quitances));
	}
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function add_quitanceAction($id)
    {
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->find($id);
        if($encaissement != null )
        {  
        	if ($encaissement->getQuitance() == null && $encaissement->getStatut() == 'valid') {
                if($encaissement->getNumPiece() != null){
                    $list_pieces = $encaissement_repository->findBy(array(
                                                                    'num_piece'=>$encaissement->getNumPiece(),
                                                                    'adherent'=>$encaissement->getAdherent(),
                                                                    'date_Operation'=>$encaissement->getDateOperation()
                                                                    ));

                    if(count($list_pieces) > 1){
                        $total_piece = $encaissement_repository->total_piece(
                                                                    $encaissement->getAdhesion(),
                                                                    $encaissement->getAdherent(),
                                                                    $encaissement->getNumPiece(),
                                                                    $encaissement->getDateOperation()
                                                                    );
                        
                        $quitance = new Quitance();
                        $quitance->setAdherent($encaissement->getAdherent()->getNomPrenom());
                        /*$quitance->setMatricule($encaissement->getAdhesion()->getMatricule());
                        $quitance->setAppartement(
                                $encaissement->getAdhesion()->getImmGroup().' | '.
                                $encaissement->getAdhesion()->getImmeuble().' | '.
                                $encaissement->getAdhesion()->getEtage().' | N° '.
                                $encaissement->getAdhesion()->getAppartement());*/
                        $quitance->setDateOperation($encaissement->getDateOperation());
                        $quitance->setModeEncaissement($encaissement->getModeEncaissement());
                        $quitance->setNumPiece($encaissement->getNumPiece());
                        $quitance->setMontant($total_piece);
                        $em = $this->getDoctrine()->getEntityManager();
                        $em->persist($quitance);
                        foreach ($list_pieces as $encaissement) {
                            $encaissement->setQuitance($quitance);
                            $em->persist($encaissement);
                            $em->flush();
                        }
                        $quitance->setNQuitance('AHGH0'.$quitance->getId());
                        $em->persist($quitance);
                        $em->flush();
                        $traceability = $this->container->get('amb_trace.traceability');
                        $traceability->AddTraceability('add', 'Ajouter quitance ID :'.$quitance->getId(), $quitance->getId(), '', 'AmbCreditBundle:Quitance');
                        return $this->redirect( $this->generateUrl('ambcredit_printquitance', array('id'=>$quitance->getId())) );
                    }
                }
	        	$quitance = new Quitance();
	        	$quitance->setAdherent($encaissement->getAdherent()->getNomPrenom());
                $quitance->setMatricule($encaissement->getAdhesion()->getMatricule());
                $quitance->setAppartement(
                        $encaissement->getAdhesion()->getImmGroup().' | '.
                        $encaissement->getAdhesion()->getImmeuble().' | '.
                        $encaissement->getAdhesion()->getEtage().' | N° '.
                        $encaissement->getAdhesion()->getAppartement());
                $quitance->setDateOperation($encaissement->getDateOperation());
                $quitance->setModeEncaissement($encaissement->getModeEncaissement());
                $quitance->setNumPiece($encaissement->getNumPiece());
	        	$quitance->setMontant($encaissement->getMontant());
                $encaissement->setQuitance($quitance);
				$em = $this->getDoctrine()->getEntityManager();
	            $em->persist($quitance);
	            $em->persist($encaissement);
	            $em->flush();
                $quitance->setNQuitance('AHGH0'.$quitance->getId());
                $em->persist($quitance);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter quitance ID :'.$quitance->getId(), $quitance->getId(), '', 'AmbCreditBundle:Quitance');
                return $this->redirect( $this->generateUrl('ambcredit_printquitance', array('id'=>$quitance->getId())) );
        	}elseif($encaissement->getQuitance() != null){
        		$quitance = $encaissement->getQuitance();
                return $this->redirect( $this->generateUrl('ambcredit_printquitance', array('id'=> $quitance->getId())) );
        	}
        }else{
            throw $this->createNotFoundException('Encaissement[id='.$id.'] inexistant ou invalide');
        }

    }
}