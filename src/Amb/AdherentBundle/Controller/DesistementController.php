<?php
namespace Amb\AdherentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\AdherentBundle\Entity\Desistement;
use Amb\AdherentBundle\Form\DesistementType;
use Amb\DebitBundle\Entity\Depense;
use Amb\DebitBundle\Form\DepenseDesistementType;
use Amb\AdherentBundle\Form\DesistementFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PHPExcel;
use PHPExcel_IOFactory;

class DesistementController extends Controller
{

    
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function change_dateAction($id, $type=null)
    {

        $desistement = $this->getDoctrine()
                            ->getRepository('AmbAdherentBundle:Desistement')
                            ->find($id);

        if($desistement == null)
        {
            throw $this->createNotFoundException('Desistement [ID '.$id.'] inexistant.');
        } 
        $formBuilder = $this->createFormBuilder();
        if($type=="new"){
            $formBuilder
                ->add('date_desistement','date',array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date'),
                    'required' => true,
                    ));
        }else{
            $formBuilder
                ->add('date_desistement','date',array(
                    'data' => $desistement->getDateDesistement(),
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date'),
                    'required' => true,
                    ));
        }
        $form = $formBuilder->getForm();
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {       
            $form->bind($request);

            $date_desistement = $form->get('date_desistement')->getData();
            $desistement = $this->getDoctrine()
                                ->getRepository('AmbAdherentBundle:Desistement')
                                ->find($id);
            $desistement->setDateDesistement($date_desistement);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($desistement);
            $em->flush();
            return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
        }

        return $this->render('AmbAdherentBundle:Desistement:change_dateDesistement.html.twig', array(
            'form' => $form->createView(),
            'dossier' => $desistement->getMatricule(),
            'id' => $id,
            'type'=> $type
        ));
    }
    
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function add_desistementAction($type, $id, $idtrans = null)
    {
        if($type == 'amb'){
            $repository_adhesion = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adhesion');
            $adhesion = $repository_adhesion->find($id);

            if($adhesion == null || $adhesion->getAdherent() == null)
            {
                throw $this->createNotFoundException('Adhésion[N° '.$id.'] inexistant.');
            }
                $repository_encaiss =   $this->getDoctrine()
                                             ->getManager()
                                             ->getRepository('AmbCreditBundle:Encaissement');
                $portfeuilles =  $repository_encaiss->findBy(array('adherent' => $adhesion->getAdherent(), 'adhesion' => $adhesion, 'matricule' => $adhesion->getMatricule(), 'statut' => 'invalid'));                            
                $desistement = new Desistement;
                $adherent = $adhesion->getAdherent();
                $desistement->setAdherent($adherent);
                $desistement->setAdhesion($adhesion);


                $desistement->setMatricule($adhesion->getMatricule());
                $desistement->setImmGroup($adhesion->getImmGroup());
                $desistement->setTypeImmeuble($adhesion->getTypeImmeuble());
                $desistement->setImmeuble($adhesion->getImmeuble());
                $desistement->setAppartement($adhesion->getAppartement());
                $desistement->setTypeAppartement($adhesion->getTypeAppartement());
                $desistement->setEtage($adhesion->getEtage());
                $desistement->setSurfaceAppt($adhesion->getSurfaceAppt());
                $desistement->setSurfaceTerrace($adhesion->getSurfaceTerrace());
                $desistement->setSurfaceJardin($adhesion->getSurfaceJardin());
                $desistement->setCout($adhesion->getCout());
                $desistement->setDateAdhesion($adhesion->getDateAdhesion());
                $desistement->setTypeEcheance($adhesion->getTypeEcheance());
                $desistement->setNbMois($adhesion->getNbMois());
                $desistement->setDateDebut($adhesion->getDateDebut());
                $desistement->setEcheance($adhesion->getEcheance());
                $desistement->setAvance($adhesion->getAvance());


                $desistement->setDateDesistement(new \Datetime());
                $desistement->setRemboursement('amb');
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($desistement);
                $adhesion->setAdherent();
                $adhesion->setMatricule('9999'); 
                $adhesion->setCout(null); 
                $adhesion->setTypeEcheance(null); 
                $adhesion->setNbMois(null); 
                $adhesion->setDateDebut(null); 
                $adhesion->setEcheance(null); 
                $adhesion->setAvance(null); 
                $adhesion->setDateDebutresrvation(null); 
                $adhesion->setDateFinresrvation(null); 
                $adhesion->setPiecereservation(null); 
                $adhesion->setMontantGarantie(null); 

                $em->persist($adhesion);
                foreach ($portfeuilles as $portfeuille) {
                    $em->remove($portfeuille);
                }
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter desistement ID :'.$desistement->getId(), $desistement->getId(), '', 'AmbAdherentBundle:Desistement');

                return $this->redirect( $this->generateUrl('ambadherent_changedatedesistement', array(
                                                                'id' => $desistement->getId()
                                                            )) );
                //return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );

        //le cas d'un désistement et transfère de la totalité d'argent vers autre appt
        }elseif ($type == 'transarg') {
            $rep_adherent = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adherent');
            $rep_adhesion = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adhesion');
            $adhesion = $rep_adhesion->find($id);

            if($adhesion == null || $adhesion->getAdherent() == null)
            {
                throw $this->createNotFoundException('Adhésion[N° '.$id.'] inexistant.');
            } 
            $adherent= $adhesion->getAdherent();
            if ($idtrans != null) {
                $adhs_trans = $rep_adhesion->find($idtrans);
                if($adhs_trans == null || $adhs_trans->getAdherent() == null)
                {
                    throw $this->createNotFoundException('Adhésion[N° '.$idtrans.'] inexistant.');
                } 
                $rep_encaiss = $this->getDoctrine()->getRepository('AmbCreditBundle:Encaissement');
                if($rep_encaiss->update_encaiss($adherent, $adhesion, $adhs_trans->getAdherent(), $adhs_trans )){
                    $portfeuilles =  $rep_encaiss->findBy(array('adherent' => $adherent, 
                                                                        'adhesion' => $adhesion, 
                                                                        'matricule' => $adhesion->getMatricule(), 
                                                                        'statut' => 'invalid'));
                    
                    $desistement = new Desistement;
                    $desistement->setAdherent($adherent);
                    $desistement->setAdhesion($adhesion);


                    $desistement->setMatricule($adhesion->getMatricule());
                    $desistement->setImmGroup($adhesion->getImmGroup());
                    $desistement->setTypeImmeuble($adhesion->getTypeImmeuble());
                    $desistement->setImmeuble($adhesion->getImmeuble());
                    $desistement->setAppartement($adhesion->getAppartement());
                    $desistement->setTypeAppartement($adhesion->getTypeAppartement());
                    $desistement->setEtage($adhesion->getEtage());
                    $desistement->setSurfaceAppt($adhesion->getSurfaceAppt());
                    $desistement->setSurfaceTerrace($adhesion->getSurfaceTerrace());
                    $desistement->setSurfaceJardin($adhesion->getSurfaceJardin());
                    $desistement->setCout($adhesion->getCout());
                    $desistement->setDateAdhesion($adhesion->getDateAdhesion());
                    $desistement->setTypeEcheance($adhesion->getTypeEcheance());
                    $desistement->setNbMois($adhesion->getNbMois());
                    $desistement->setDateDebut($adhesion->getDateDebut());
                    $desistement->setEcheance($adhesion->getEcheance());
                    $desistement->setAvance($adhesion->getAvance());


                    $desistement->setDateDesistement(new \Datetime());
                    $desistement->setLibelle('transfère des encaissements vers autre appt');
                        $em = $this->getDoctrine()->getEntityManager();
                        $em->persist($desistement);
                    $adhesion->setAdherent();
                    $adhesion->setMatricule('9999'); 
                    $adhesion->setCout(null); 
                    $adhesion->setTypeEcheance(null); 
                    $adhesion->setNbMois(null); 
                    $adhesion->setDateDebut(null); 
                    $adhesion->setEcheance(null); 
                    $adhesion->setAvance(null); 

                    $em->persist($adhesion);
                    foreach ($portfeuilles as $portfeuille) {
                        $em->remove($portfeuille);
                    }
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('add', 'Ajouter desistement ID :'.$desistement->getId(), $desistement->getId(), '', 'AmbAdherentBundle:Desistement');

                    //return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );

                    return $this->redirect( $this->generateUrl('ambadherent_changedatedesistement', array(
                                                                    'id' => $desistement->getId()
                                                                )) );
                }
            }
            $adhesions = $rep_adhesion->ApptforDesist($adherent ,$adhesion->getId());
            return $this->render('AmbAdherentBundle:Desistement:listappt_adherent.html.twig', array(
                'adhesion' => $adhesion,
                'adherent' => $adherent,
                'adhesions' => $adhesions,
            ));
        //le cas d'appt et tous les encaissements a un autre adhrent
        }elseif ($type == 'transappt') {
            $rep_adherent = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adherent');
            $rep_adhesion = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adhesion');
            $adhesion = $rep_adhesion->find($id);

            if($adhesion == null || $adhesion->getAdherent() == null)
            {
                throw $this->createNotFoundException('Adhésion[N° '.$id.'] inexistant.');
            } 
            $adherent= $adhesion->getAdherent();
            $formBuilder = $this->createFormBuilder();
            $formBuilder
                ->add('adherent', 'entity', array(
                                    'class' => 'AmbAdherentBundle:Adherent',
                                    'query_builder' => function($rep_adherent) {
                                        return $rep_adherent->createQueryBuilder('a')
                                            ->orderBy('a.nom_prenom', 'ASC');
                                    },
                                    'property' => 'NomPrenom',
                                ));
            $form = $formBuilder->getForm();

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {       $form->bind($request);
                    $id_newadherent = $form->get('adherent')->getData();
                if ($id_newadherent != null) {
                    $new_adherent = $rep_adherent->find($id_newadherent->getId());
                    if($new_adherent == null )
                    {
                        throw $this->createNotFoundException('Adherent[N° '.$id_newadherent.'] inexistant.');
                    } 
                    $rep_encaiss = $this->getDoctrine()->getRepository('AmbCreditBundle:Encaissement');
                    if($rep_encaiss->update_encaiss($adherent, $adhesion, $new_adherent, $adhesion )){
                        $portfeuilles =  $rep_encaiss->findBy(array('adherent' => $adherent, 
                                                                            'adhesion' => $adhesion, 
                                                                            'matricule' => $adhesion->getMatricule(), 
                                                                            'statut' => 'invalid'));
                        
                        $desistement = new Desistement;
                        $desistement->setAdherent($adherent);
                        $desistement->setAdhesion($adhesion);


                        $desistement->setMatricule($adhesion->getMatricule());
                        $desistement->setImmGroup($adhesion->getImmGroup());
                        $desistement->setTypeImmeuble($adhesion->getTypeImmeuble());
                        $desistement->setImmeuble($adhesion->getImmeuble());
                        $desistement->setAppartement($adhesion->getAppartement());
                        $desistement->setTypeAppartement($adhesion->getTypeAppartement());
                        $desistement->setEtage($adhesion->getEtage());
                        $desistement->setSurfaceAppt($adhesion->getSurfaceAppt());
                        $desistement->setSurfaceTerrace($adhesion->getSurfaceTerrace());
                        $desistement->setSurfaceJardin($adhesion->getSurfaceJardin());
                        $desistement->setCout($adhesion->getCout());
                        $desistement->setDateAdhesion($adhesion->getDateAdhesion());
                        $desistement->setTypeEcheance($adhesion->getTypeEcheance());
                        $desistement->setNbMois($adhesion->getNbMois());
                        $desistement->setDateDebut($adhesion->getDateDebut());
                        $desistement->setEcheance($adhesion->getEcheance());
                        $desistement->setAvance($adhesion->getAvance());


                        $desistement->setDateDesistement(new \Datetime());
                        $desistement->setLibelle('renonciation d\'appt et les encaissements pour un autre adherent');
                            $em = $this->getDoctrine()->getEntityManager();
                            $em->persist($desistement);
                        $adhesion->setAdherent($new_adherent); 

                        $em->persist($adhesion);
                        foreach ($portfeuilles as $portfeuille) {
                            $em->remove($portfeuille);
                        }
                        $em->flush();
                        $traceability = $this->container->get('amb_trace.traceability');
                        $traceability->AddTraceability('add', 'Ajouter desistement ID :'.$desistement->getId(), $desistement->getId(), '', 'AmbAdherentBundle:Desistement');

                        //return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );

                        return $this->redirect( $this->generateUrl('ambadherent_changedatedesistement', array(
                                                                        'id' => $desistement->getId()
                                                                    )) );
                    }
                }
            }

            return $this->render('AmbAdherentBundle:Desistement:change_adherent.html.twig', array(
                'form' => $form->createView(),
                'adhesion' => $adhesion
            ));
        }
        return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_desistementAction($format)
    {

        $form = $this->get('form.factory')->create(new DesistementFilterType());

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();
            $rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Desistement');
            $filterBuilder = $rep->ListDesistement();
            $rq_total = $rep->TotalRemboursement();
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $rq_total);
            $desistements = $filterBuilder->getQuery()->getResult();
            $total = $rq_total->getQuery()->getSingleScalarResult();

            if ($format == 'pdf') {
                $html = $this->render('AmbAdherentBundle:Desistement:list_desistement.pdf.twig', array(
                    'desistements' => $desistements,
                    'total' => $total,
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
            return $this->render('AmbAdherentBundle:Desistement:list_desistement.html.twig', array(
                'form' => $form->createView(), 
                'desistements' => $desistements,
                'total' => $total,
                ));
            }
        }



        $rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Desistement');
        $desistements = $rep->ListDesistement('nofilter');
        $total = $rep->TotalRemboursement('nofilter');
        $desistements = $desistements->getQuery()->getResult();
        $total = $total->getQuery()->getSingleScalarResult();
        return $this->render('AmbAdherentBundle:Desistement:list_desistement.html.twig', array(
            'form' => $form->createView(), 
            'desistements' => $desistements,
            'total' => $total,
            ));
    }


    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function detail_desistementAction($id, $format)
    {
        $repository_adhesion = $this->getDoctrine()
                                    ->getRepository('AmbAdherentBundle:Adhesion');
        $repository_desist = $this->getDoctrine()
                                    ->getRepository('AmbAdherentBundle:Desistement');
        $repository_encaissement = $this->getDoctrine()
                                    ->getRepository('AmbCreditBundle:Encaissement');
        $repository_depense = $this->getDoctrine()
                                    ->getRepository('AmbDebitBundle:Depense');
        $desistement = $repository_desist->find($id);
        $adherent = $desistement->getAdherent();
        $adhesion = $desistement->getAdhesion();
        $encaissements = $repository_encaissement->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$desistement->getMatricule()));
        $depenses = $repository_depense->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$desistement->getMatricule()));
        if($desistement == null)
        {
            throw $this->createNotFoundException('Desistement[N° '.$id.'] inexistant.');
        }

        $date_debut = $desistement->getDateDebut(); 
        if ($date_debut != null) {
            $nb_mois_ecoule = $this->diff_en_entre_deux_date($date_debut->format('Y-m-d'),date("Y-m-d"), 'mois' );
            $echeance = $nb_mois_ecoule/$desistement->getTypeEcheance();
        }else{
            $nb_mois_ecoule = null;
            $echeance = null;
        }
        if ($format == 'pdf') {
            //$adhesion = $repository_adhesion->findDetailByAdhesion($adhesion->getId());
            $html = $this->render('AmbAdherentBundle:Desistement:consult_desistement.pdf.twig', array( 
                    'desistement' => $desistement,
                    'adherent' => $adherent,
                    'encaissements' => $encaissements,
                    'depenses' => $depenses,
                    'nb_mois' => $nb_mois_ecoule,
                    'echeance' => (int)$echeance
                ));
            $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('detail_adhesion_'.$id.'.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            //$detail_adhesion = $repository_adhesion->findDetailByAdhesion($adhesion->getId());
            return $this->render('AmbAdherentBundle:Desistement:consult_desistement.html.twig', array(
                'desistement' => $desistement,
                'adherent' => $adherent,
                'encaissements' => $encaissements,
                'depenses' => $depenses,
                'nb_mois' => $nb_mois_ecoule,
                'echeance' => (int)$echeance
            )); 
        }
    }

    public function diff_en_entre_deux_date($start,$end,$type='jour') 
    {
        //$date_format = YYYY-m-d
        //$date_format = YYYY-m-d
        sscanf($start, "%4s-%2s-%2s", $annee, $mois, $jour);
        $a1 = $annee;
        $m1 = $mois;
        sscanf($end, "%4s-%2s-%2s", $annee, $mois, $jour);
        $a2 = $annee;
        $m2 = $mois;

        $start_time = strtotime($start);
        $end_time = strtotime($end);
        if($type == 'jour') {
          $diff = ($end_time - $start_time)/ 86400 ; // 86400 = 24*60*60
        } elseif($type == 'semaine') {
          $diff = floor(($end_time - $start_time) / 604800) ; // 604800 = 24*60*60*7
        } elseif($type == 'mois') {
          $diff = ($m2-$m1)+12*($a2-$a1);
        } elseif($type == 'annee') {
          $diff = $a2-$a1;
        }
        return $diff ;
    }
}