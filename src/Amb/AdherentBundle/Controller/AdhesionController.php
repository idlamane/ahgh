<?php
namespace Amb\AdherentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Amb\AdherentBundle\Entity\Adherent;
use Amb\AdherentBundle\Entity\Adhesion;
//use Amb\AdherentBundle\Form\AdherentType;
use Amb\AdherentBundle\Form\AdhesionType;
use Amb\AdherentBundle\Form\EcheanceType;
use Amb\AdherentBundle\Form\ApptType;
use Amb\AdherentBundle\Form\AdhesionFilterType;
use Amb\AdherentBundle\Form\ReservationFilterType;
use Amb\AdherentBundle\Form\ApptFilterType;
use Amb\CreditBundle\Form\EncaissementType;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Amb\UserBundle\Entity\User;

use PHPExcel;
use PHPExcel_IOFactory;

class AdhesionController extends Controller
{

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function add_adhesionAction($id, $mode)
    {
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
        $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');

        if ($mode == 'res') {
            $adhesion = $this->getDoctrine()
                             ->getRepository('AmbAdherentBundle:Adhesion')
                             ->find($id);
            if($adhesion == null || $adhesion->getAdherent() != null)
            {
                throw $this->createNotFoundException('Appartement inexistant ou bien déja occupé.');
            }

            $form = $this->createForm(new AdhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement, true ), $adhesion);
            
            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {
                    $em = $this->getDoctrine()->getEntityManager();
                    $adhesion->setAdherent($form->get('adherent')->getData());
                    $adhesion->setMatricule($form->get('matricule')->getData());
                    $adhesion->setDossier($form->get('dossier')->getData());
                    $adhesion->setTypeImmeuble($form->get('type_immeuble')->getData());
                    $adhesion->setTypeAppartement($form->get('type_appartement')->getData());
                    $adhesion->setSurfaceAppt($form->get('surface_appt')->getData());
                    $adhesion->setSurfaceTerrace($form->get('surface_terrace')->getData());
                    $adhesion->setSurfaceJardin($form->get('surface_jardin')->getData());
                    $adhesion->setCout($form->get('cout')->getData());
                    $adhesion->setTypeEcheance($form->get('type_echeance')->getData());
                    $adhesion->setNbMois($form->get('nb_mois')->getData());
                    $adhesion->setDateDebut($form->get('date_debut')->getData());
                    $adhesion->setEcheance($form->get('echeance')->getData());
                    $adhesion->setAvance($form->get('avance')->getData());
                    $adhesion->setCommentaire($form->get('commentaire')->getData());

                    $em = $this->getDoctrine()->getEntityManager();
                    $uow = $em->getUnitOfWork();
                    $uow->computeChangeSets();
                    $changeset = $uow->getEntityChangeSet($adhesion);
                    $em->persist($adhesion);
                    $desistement = $this->getDoctrine()
                                        ->getRepository('AmbAdherentBundle:Desistement')
                                        ->findBy(array(
                                            'adherent'=>$adhesion->getAdherent(),
                                            'adhesion'=>$adhesion, 
                                            'matricule'=>$adhesion->getMatricule()));

                    $verif_matricule = $this->getDoctrine()
                                            ->getRepository('AmbAdherentBundle:Adhesion')
                                            ->createQueryBuilder('a')
                                            ->select('COUNT(a)')
                                            ->where('a.matricule = :matricule')
                                            ->andWhere('a.adherent IS NOT NULL')
                                            ->setParameter('matricule', $form->get('matricule')->getData())
                                            ->getQuery()
                                            ->getSingleScalarResult();               

                    if (count($desistement)) {
                        return $this->render('AmbAdherentBundle:Adhesion:ajouter_adhesion.html.twig', array(
                        'form' => $form->createView(),
                        'adhesion_validation_error' => 'Désolé, cet adhérent n\'accepte pas ce matricule, car il a déja désister de cette appt avec le même matricule.',
                        ));                 
                    } 
                    if ($verif_matricule!=0) {
                        return $this->render('AmbAdherentBundle:Adhesion:ajouter_adhesion.html.twig', array(
                        'form' => $form->createView(),
                        'adhesion_validation_error' => 'Désolé, le matricule que vous avez saisi existe déja.',
                        ));                 
                    }                     
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('update', 'reservation adhesion ID :'.$adhesion->getId(), $adhesion->getId(), $changeset, 'AmbAdherentBundle:Adhesion');
                    
                    return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                        'id' => $adhesion->getAdherent()->getId()
                    )));
                }
            }
            return $this->render('AmbAdherentBundle:Adhesion:ajouter_adhesion.html.twig', array(
            'form' => $form->createView(),
            ));
        }

        $adherent = $this->getDoctrine()
                           ->getRepository('AmbAdherentBundle:Adherent')
                           ->find($id);
        if($adherent != null)
        {   
            $adhesion = new adhesion();

            $adhesion->setDateAdhesion(new \Datetime());
            $adhesion->setAdherent($adherent);
            $form = $this->createForm(new AdhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement ), $adhesion);

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();
                    $adhesion_repository = $this->getDoctrine()
                                                ->getRepository('AmbAdherentBundle:Adhesion');
                    $adhesion_validation = $adhesion_repository->ApptIsLibre($adhesion->getImmGroup(),
                                                                             $adhesion->getImmeuble(),
                                                                             $adhesion->getAppartement());
                    if(!empty($adhesion_validation)){
                        if($adhesion_validation->getAdherent() != null){
                            //appt déja réserver par un autre adherent
                            return $this->render('AmbAdherentBundle:Adhesion:ajouter_adhesion.html.twig', array(
                                            'form' => $form->createView(),
                                            'adhesion_validation_error' => 'Désolé, cette appartement est déja réservé par l\'adhérent '.$adhesion_validation->getAdherent()->getCivilite().'. '.$adhesion_validation->getAdherent()->getNomPrenom().'.',
                                            ));
                        }elseif ($adhesion_validation->getAdherent() == null) {


                            //reserver une appt déja existe a l'adherent courant
                            $adhesion = $this->getDoctrine()
                                             ->getRepository('AmbAdherentBundle:Adhesion')
                                             ->find($adhesion_validation->getId());
                            
                            $adhesion->setAdherent($adherent);
                            $adhesion->setDateAdhesion(new \Datetime());
                            $adhesion->setMatricule($form->get('matricule')->getData());
                            $adhesion->setDossier($form->get('dossier')->getData());
                            $adhesion->setTypeImmeuble($form->get('type_immeuble')->getData());
                            $adhesion->setTypeAppartement($form->get('type_appartement')->getData());
                            $adhesion->setSurfaceAppt($form->get('surface_appt')->getData());
                            $adhesion->setSurfaceTerrace($form->get('surface_terrace')->getData());
                            $adhesion->setSurfaceJardin($form->get('surface_jardin')->getData());
                            $adhesion->setCout($form->get('cout')->getData());
                            $adhesion->setTypeEcheance($form->get('type_echeance')->getData());
                            $adhesion->setNbMois($form->get('nb_mois')->getData());
                            $adhesion->setDateDebut($form->get('date_debut')->getData());
                            $adhesion->setEcheance($form->get('echeance')->getData());
                            $adhesion->setAvance($form->get('avance')->getData());
                            $adhesion->setCommentaire($form->get('commentaire')->getData());

                            $em = $this->getDoctrine()->getEntityManager();
                            $uow = $em->getUnitOfWork();
                            $uow->computeChangeSets();
                            $changeset = $uow->getEntityChangeSet($adhesion);
                            $em->persist($adhesion);
                            $em->flush();
                            $traceability = $this->container->get('amb_trace.traceability');
                            $traceability->AddTraceability('update', 'modifier adhesion ID :'.$adhesion->getId(), $adhesion->getId(), $changeset, 'AmbAdherentBundle:Adhesion');
                            
                            return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                                'id' => $adhesion->getAdherent()->getId()
                            )));
                            /*return $this->redirect( $this->generateUrl('ambadherent_reserverapptlibre', array(
                                'id_adhesion' => $adhesion_validation->getId()
                            )));   */
                        }
                    }else{
                        //nouvelle appt pour l'adherent courant
                        $em->persist($adhesion);
                        $em->flush();
                        $traceability = $this->container->get('amb_trace.traceability');
                        $traceability->AddTraceability('add', 'Ajouter adhesion ID :'.$adhesion->getId(), $adhesion->getId(), '', 'AmbAdherentBundle:Adhesion');
                        
                    }
                    $adhesions = $adherent->getAdhesions();
                    return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                        'id' => $id,
                        'adherent' => $adherent,
                        'adhesions' => $adhesions,
                    )));
                }
            }

            return $this->render('AmbAdherentBundle:Adhesion:ajouter_adhesion.html.twig', array(
            'form' => $form->createView(),
            ));
        }
        return $this->redirect( $this->generateUrl('ambadherent_accueil'));

    }


    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function update_adhesionAction($id_adhesion)
    {
        $rep_adh = $this->getDoctrine()
                           ->getRepository('AmbAdherentBundle:Adhesion');
        $adhesion = $rep_adh->find($id_adhesion);

        if($adhesion == null)
        {
            throw $this->createNotFoundException('Adhésion[N° '.$id_adhesion.'] inexistant.');
        }
        $encaissements = $this->getDoctrine()
                           ->getRepository('AmbCreditBundle:Encaissement')
                           ->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adhesion->getAdherent(), 'matricule'=>$adhesion->getMatricule() ));
        $restitutions = $this->getDoctrine()
                           ->getRepository('AmbDebitBundle:Depense')
                           ->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adhesion->getAdherent(), 'matricule'=>$adhesion->getMatricule() ));
        //verouillage du champs matricule si il y a des encaissments
        $matricule_locked = false;
        if (count($encaissements) || count($restitutions)  ) {
            $matricule_locked = true;
        }                   
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
        $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');

        
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN') && !$this->get('security.context')->isGranted('ROLE_MANAGERSUP')) {
            $form = $this->createForm(new AdhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement, null,'update' ), $adhesion);
        }else{
            $form = $this->createForm(new AdhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement ), $adhesion);
        }
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            //récuperer les anciennes valeurs de l'appt
            $old_ImmGroup = $adhesion->getImmGroup();
            $old_Immeuble = $adhesion->getImmeuble();
            $old_Etage = $adhesion->getEtage();
            $old_Appartement = $adhesion->getAppartement();
            $old_SupAppt = $adhesion->getSurfaceAppt();
            $old_SupTer = $adhesion->getSurfaceTerrace();
            $old_SupJar = $adhesion->getSurfaceJardin();

            $form->bind($request);
            if( $form->isValid() )
            {
                $em = $this->getDoctrine()->getEntityManager();

                if($old_ImmGroup != $form->get('imm_group')->getData() ||
                $old_Immeuble != $form->get('immeuble')->getData() ||
                $old_Appartement != $form->get('appartement')->getData() )
                {
                    
                    $appt_is_libre = $rep_adh->ApptIsLibre($form->get('imm_group')->getData() ,
                                                                         $form->get('immeuble')->getData() ,
                                                                         $form->get('appartement')->getData() );
                    if(!empty($appt_is_libre)){
                        if($appt_is_libre->getAdherent() != null){
                            //appt déja réserver par un autre adherent
                            return $this->render('AmbAdherentBundle:Adhesion:modifier_adhesion.html.twig', array(
                                            'form' => $form->createView(),
                                            'matricule_locked' => $matricule_locked,
                                            'adhesion_validation_error' => 'Désolé, cette appartement est déja réservé par l\'adhérent '.$appt_is_libre->getAdherent()->getCivilite().'. '.$appt_is_libre->getAdherent()->getNomPrenom().'.',
                                            ));
                        }else{
                            $appt_is_libre->setImmGroup($old_ImmGroup);
                            $appt_is_libre->setImmeuble($old_Immeuble);
                            $appt_is_libre->setEtage($old_Etage);
                            $appt_is_libre->setAppartement($old_Appartement);
                            $appt_is_libre->setSurfaceAppt($old_SupAppt);
                            $appt_is_libre->setSurfaceTerrace($old_SupTer);
                            $appt_is_libre->setSurfaceJardin($old_SupJar);
                            $em->persist($appt_is_libre);

                        }
                    }
                }


                
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($adhesion);
                $em->persist($adhesion);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier adhesion ID :'.$id_adhesion, $id_adhesion, $changeset, 'AmbAdherentBundle:Adhesion');
                $adherent = $adhesion->getAdherent();
                return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                    'id' => $adherent->getId()
                )));
            }


        }

        return $this->render('AmbAdherentBundle:Adhesion:modifier_adhesion.html.twig', array(
        'form' => $form->createView(),
        'matricule_locked' => $matricule_locked,
        ));
    }


    /**
    * @Secure(roles="ROLE_MANAGERSUP")
    */
    public function change_adhesionAction($id_adhesion)
    {
        $rep_adh = $this->getDoctrine()
                           ->getRepository('AmbAdherentBundle:Adhesion');
        $adhesion = $rep_adh->find($id_adhesion);

        if($adhesion == null)
        {
            throw $this->createNotFoundException('Adhésion[N° '.$id_adhesion.'] inexistant.');
        }  
        $matricule_locked = true;                 
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
        $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');

        
        $form = $this->createForm(new adhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement ), $adhesion);
        
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            //récuperer les anciennes valeurs de l'appt
            $old_ImmGroup = $adhesion->getImmGroup();
            $old_Immeuble = $adhesion->getImmeuble();
            $old_Etage = $adhesion->getEtage();
            $old_Appartement = $adhesion->getAppartement();
            $old_SupAppt = $adhesion->getSurfaceAppt();

            $old_TypeImmeuble = $adhesion->getTypeImmeuble();
            $old_TypeAppartement = $adhesion->getTypeAppartement();

            $old_SupTer = $adhesion->getSurfaceTerrace();
            $old_SupJar = $adhesion->getSurfaceJardin();

            $form->bind($request);
            if( $form->isValid() )
            {
                $em = $this->getDoctrine()->getEntityManager();

                if($old_ImmGroup != $form->get('imm_group')->getData() ||
                $old_Immeuble != $form->get('immeuble')->getData() ||
                $old_Appartement != $form->get('appartement')->getData() )
                {
                    
                    $appt_is_libre = $rep_adh->ApptIsLibre($form->get('imm_group')->getData() ,
                                                                         $form->get('immeuble')->getData() ,
                                                                         $form->get('appartement')->getData() );
                    if(!empty($appt_is_libre)){
                        if($appt_is_libre->getAdherent() != null){
                            //appt déja réserver par un autre adherent
                            return $this->render('AmbAdherentBundle:Adhesion:modifier_adhesion.html.twig', array(
                                            'form' => $form->createView(),
                                            'matricule_locked' => $matricule_locked,
                                            'adhesion_validation_error' => 'Désolé, cette appartement est déja réservé par l\'adhérent '.$appt_is_libre->getAdherent()->getCivilite().'. '.$appt_is_libre->getAdherent()->getNomPrenom().'.',
                                            ));
                        }else{
                            $appt_is_libre->setImmGroup($old_ImmGroup);
                            $appt_is_libre->setImmeuble($old_Immeuble);
                            $appt_is_libre->setEtage($old_Etage);
                            $appt_is_libre->setAppartement($old_Appartement);

                            $appt_is_libre->setTypeImmeuble($old_TypeImmeuble);
                            $appt_is_libre->setTypeAppartement($old_TypeAppartement);

                            $appt_is_libre->setSurfaceAppt($old_SupAppt);
                            $appt_is_libre->setSurfaceTerrace($old_SupTer);
                            $appt_is_libre->setSurfaceJardin($old_SupJar);
                            $em->persist($appt_is_libre);

                        }
                    }
                }


                
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($adhesion);
                $em->persist($adhesion);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier adhesion ID :'.$id_adhesion, $id_adhesion, $changeset, 'AmbAdherentBundle:Adhesion');
                $adherent = $adhesion->getAdherent();
                return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                    'id' => $adherent->getId()
                )));
            }


        }

        return $this->render('AmbAdherentBundle:Adhesion:modifier_adhesion.html.twig', array(
        'form' => $form->createView(),
        'matricule_locked' => $matricule_locked,
        'adhesion' => $adhesion,
        ));
    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function detail_adhesionAction($id, $format)
    {
        $repository_adhesion = $this->getDoctrine()
                                    ->getRepository('AmbAdherentBundle:Adhesion');
        $repository_encaissement = $this->getDoctrine()
                                    ->getRepository('AmbCreditBundle:Encaissement');
        $repository_depense = $this->getDoctrine()
                                    ->getRepository('AmbDebitBundle:Depense');
        $adhesion = $repository_adhesion->find($id);
        $adherent = $adhesion->getAdherent();
        $encaissements = $repository_encaissement->findBy(
                                            array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$adhesion->getMatricule()),
                                            array('date_Operation'=>'asc'));
        $depenses = $repository_depense->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$adhesion->getMatricule()));
        if($adhesion == null)
        {
            throw $this->createNotFoundException('Adhésion[N° '.$id.'] inexistant.');
        }

        $date_debut = $adhesion->getDateDebut(); 
        if ($date_debut != null) {
            $nb_mois_ecoule = $this->diff_en_entre_deux_date($date_debut->format('Y-m-d'),date("Y-m-d"), 'mois' );
            $echeance = $nb_mois_ecoule/$adhesion->getTypeEcheance();
        }else{
            $nb_mois_ecoule = null;
            $echeance = null;
        }
        if ($format == 'pdf') {
            $adhesion = $repository_adhesion->findDetailByAdhesion($adhesion->getId());
            $html = $this->render('AmbAdherentBundle:Adhesion:consult_adhesion.pdf.twig', array( 
                    'adhesion' => $adhesion,
                    'adherent' => $adherent,
                    //'total_portfeuille' => $total_portfeuille,
                    //'total_impaye' => $total_impaye,
                    //'total_invalid' => $total_invalid,
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
            $detail_adhesion = $repository_adhesion->findDetailByAdhesion($adhesion->getId());
            //$total_portfeuille = $repository_encaissement->total_portefeuille($adhesion, $adherent);
            //$total_impaye = $repository_encaissement->total_impaye($adhesion, $adherent);
            //$total_invalid = $repository_encaissement->total_invalid($adhesion, $adherent);
            return $this->render('AmbAdherentBundle:Adhesion:consult_adhesion.html.twig', array(
                'adhesion' => $detail_adhesion,
                'adherent' => $adherent,
                //'total_portfeuille' => $total_portfeuille,
                //'total_impaye' => $total_impaye,
                //'total_invalid' => $total_invalid,
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

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function reserver_apptlibreAction($id_adhesion)
    {
        $adhesion = $this->getDoctrine()
                           ->getRepository('AmbAdherentBundle:Adhesion')
                           ->find($id_adhesion);

        if($adhesion == null || $adhesion->getAdherent() != null)
        {
            throw $this->createNotFoundException('Appartement inexistant ou bien déja occupé.');
        }
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
        $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');


        $form = $this->createForm(new AdhesionType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement, true ), $adhesion);
       
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $adhesion->setDateAdhesion(new \Datetime());
                $em = $this->getDoctrine()->getEntityManager();
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($adhesion);
                $em->persist($adhesion);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier adhesion ID :'.$id_adhesion, $id_adhesion, $changeset, 'AmbAdherentBundle:Adhesion');
                return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                    'id' => $adhesion->getAdherent()->getId()
                )));
            }
        }

        return $this->render('AmbAdherentBundle:Adhesion:ajouter_reservation.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
    * @Secure(roles="ROLE_ADMIN")
    */
    public function delete_adhesionAction($id)
    {
        $adhesion_repository = $this->getDoctrine()
                                        ->getRepository('AmbAdherentBundle:Adhesion');
        $adhesion = $adhesion_repository->find($id);
        if($adhesion != null)
        {  
            $adherent = $adhesion->getAdherent();
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($adhesion);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', 'supprimer adhesion ID :'.$id, $id,'', 'AmbAdherentBundle:Adhesion');
                return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                    'id' => $adherent->getId()
                )));
        }
        if($adhesion === null)
        {
            throw $this->createNotFoundException('Adhésion[N° '.$id.'] inexistant.');
        }

    }

    /**
    * @Secure(roles="ROLE_COMM")
    */
    public function list_adhesionAction($id, $type, $print = null)
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Adherent');
        $adherent = $repository->find($id);
        $repository_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');
        if($adherent == null)
        {
            $ambexceldb = $this->container->get('amb_credit.ambexceldb');
            $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
            $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
            $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
            $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');
            $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
            $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');

            $form = $this->get('form.factory')->create(new AdhesionFilterType($type_immeuble, $immeuble, $etage, $type_appartement, $imm_group, $appartement));
            

            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                $type_immeuble = $form->get('type_immeuble')->getData();
                $immeuble = $form->get('immeuble')->getData();
                $etage = $form->get('etage')->getData();
                $type_appartement = $form->get('type_appartement')->getData();
                $imm_group = $form->get('imm_group')->getData();
                $dossier = $form->get('dossier')->getData();
                $matricule = $form->get('matricule')->getData();
                $versement = $form->get('versement')->getData();
                $pourcentage = $form->get('pourcent_vers_port')->getData();
                $appartement = $form->get('appartement')->getData();
                $surface = $form->get('surface_appt')->getData();
                if (is_object($surface)){
                    $surface=$surface->getSurfaceAppt();
                }
                $adh_solde = $form->get('adh_solde')->getData();
                $adhesions = $repository_adhesion->findDetailAdhesionAll(
                                                    $type_immeuble,
                                                    $immeuble,
                                                    $etage,
                                                    $type_appartement,
                                                    $imm_group,
                                                    $dossier,
                                                    $matricule,
                                                    $versement,
                                                    $appartement,
                                                    $surface,
                                                    $adh_solde,
                                                    $pourcentage
                                                    );

                if ($print == 'print') {

                    if ($type=='rec') {
                        $html = $this->render('AmbAdherentBundle:Adhesion:list_adhesion_recouv.pdf.twig', array(
                            'adhesions' => $adhesions,
                            'titre' => 'Liste des adhésions'
                        ));
                    }else{
                        $html = $this->render('AmbAdherentBundle:Adhesion:list_adhesion.pdf.twig', array(
                            'adhesions' => $adhesions,
                            'titre' => 'Liste des adhésions'
                        ));
                    }
                    
                    $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->writeHTML($html->getContent());
                    $html = $html2pdf->Output('list_adhesions.pdf');
                    $response = new Response();
                    $response->clearHttpHeaders();
                    $response->setContent(file_get_contents($html));
                    $response->headers->set('Content-Type', 'application/force-download');
                    $response->headers->set('Content-disposition', 'filename='. $html); 
                    return $response;
                }else{
                    if ($type=='rec') {
                        return $this->render('AmbAdherentBundle:Adhesion:list_adhesion_recouv.html.twig', array(
                                'form' => $form->createView(), 
                                'adhesions' => $adhesions,
                                'titre' => 'Liste des adhésions'
                        ));
                    }else{
                        return $this->render('AmbAdherentBundle:Adhesion:list_adhesion.html.twig', array(
                                'form' => $form->createView(), 
                                'adhesions' => $adhesions,
                                'titre' => 'Liste des adhésions'
                        ));
                    }
                }
            }    

                /*$qb = $repository_adhesion->findDetailAdhesionAll();

                $test=$qb->getQuery();
                $adhesions = $qb->getQuery()->getResult();*/
                $adhesions = $repository_adhesion->findDetailAdhesionAll();

                if ($type=='rec') {
                    return $this->render('AmbAdherentBundle:Adhesion:list_adhesion_recouv.html.twig', array(
                            'form' => $form->createView(), 
                            'adhesions' => $adhesions,
                            'titre' => 'Liste des adhésions'
                    ));
                }else{
                    return $this->render('AmbAdherentBundle:Adhesion:list_adhesion.html.twig', array(
                            'form' => $form->createView(), 
                            'adhesions' => $adhesions,
                            'titre' => 'Liste des adhésions'
                    ));
                }
        }
        $adhesions = $repository_adhesion->findDetailByAdherent($adherent->getId());
        return $this->render('AmbAdherentBundle:Adhesion:list_adhesion.html.twig', array(
            'adherent' => $adherent,
            'adhesions' => $adhesions,
            'titre' => 'Liste des adhésions'
        ));
    }

    /**
    * @Secure(roles="ROLE_COMM")
    */
    public function list_apptlibreAction()
    {

        $repository_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $n_appt = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');

        $form = $this->get('form.factory')->create(new ApptFilterType($immeuble, $etage, $imm_group, $n_appt));
        

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
          
            $filterBuilder = $repository_adhesion->createQueryBuilder('a');
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $filterBuilder->andwhere('a.adherent is null');
            $appts = $filterBuilder->getQuery()->getResult();

            return $this->render('AmbAdherentBundle:Adhesion:list_apptlibre.html.twig', array(
            'form' => $form->createView(),
            'adhesions' => $appts
            ));
        }    

        $appts = $repository_adhesion->findBy(array('adherent' => null));
        return $this->render('AmbAdherentBundle:Adhesion:list_apptlibre.html.twig', array(
            'form' => $form->createView(),
            'adhesions' => $appts
        ));
    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function list_reservationAction($format)
    {

        $repository_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
        $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
        $n_appt = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
        $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');

        $form = $this->get('form.factory')->create(new ReservationFilterType($immeuble, $etage, $imm_group, $n_appt));
        

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
          
            $filterBuilder = $repository_adhesion->findListReservation();
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            //$filterBuilder->andwhere('a.adherent is null');
            $appts = $filterBuilder->getQuery()->getResult();

            //$appts = $repository_adhesion->findListReservation();

            return $this->render('AmbAdherentBundle:Adhesion:list_reservation.html.twig', array(
            'form' => $form->createView(),
            'adhesions' => $appts
            ));
        }    

        //$appts = $repository_adhesion->findBy(array('adherent' => null));
        $appts = $repository_adhesion->findListReservation()->getQuery()->getResult();
        return $this->render('AmbAdherentBundle:Adhesion:list_reservation.html.twig', array(
            'form' => $form->createView(),
            'adhesions' => $appts
        ));
    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function cancel_reservationAction($id)
    {
        $rep_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');
        $appt = $rep_adhesion->find($id);
        if($appt === null)
        {
            throw $this->createNotFoundException('Adhesion[N° '.$id.'] inexistant.');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $repository_encaiss =   $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AmbCreditBundle:Encaissement');
        $portfeuilles =  $repository_encaiss->findBy(array('adherent' => $appt->getAdherent(), 'adhesion' => $appt, 'matricule' => $appt->getMatricule()));

        
        foreach ($portfeuilles as $portfeuille) {
            $em->remove($portfeuille);
        }
        $appt->setAdherent(null);
        $appt->setDateDebutresrvation(null);
        $appt->setDateFinresrvation(null);
        $appt->setPieceReservation(null);
        $appt->setMontantGarantie(null);
        $appt->setMatricule('9000');

        $uow = $em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($appt);
        $em->persist($appt);
        $em->flush();
        $traceability = $this->container->get('amb_trace.traceability');
        $traceability->AddTraceability('update', 'annuler la reservation ID :'.$id, $id, $changeset, 'AmbAdherentBundle:Adhesion');
        
        return $this->redirect( $this->generateUrl('ambadherent_listreservation'));


    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function confirm_reservationAction($id)
    {
        $rep_adhesion = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('AmbAdherentBundle:Adhesion');
        $appt = $rep_adhesion->find($id);
        if($appt === null)
        {
            throw $this->createNotFoundException('Adhesion[N° '.$id.'] inexistant.');
        }
        $appt->setDateDebutresrvation(null);
        $appt->setDateFinresrvation(null);
        $appt->setPieceReservation(null);
        $appt->setMontantGarantie(null);
        $em = $this->getDoctrine()->getEntityManager();

        $uow = $em->getUnitOfWork();
        $uow->computeChangeSets();
        $changeset = $uow->getEntityChangeSet($appt);
        $em->persist($appt);
        $em->flush();
        $traceability = $this->container->get('amb_trace.traceability');
        $traceability->AddTraceability('update', 'confirmer la reservation ID :'.$id, $id, $changeset, 'AmbAdherentBundle:Adhesion');
        
        return $this->redirect( $this->generateUrl('ambadherent_listreservation'));


    }


    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function update_apptAction($id)
    {
        $rep = $this->getDoctrine()->getrepository('AmbAdherentBundle:Adhesion');
        $appt = $rep->find($id);
        if($appt != null){

            $ambexceldb = $this->container->get('amb_credit.ambexceldb');
            $imm_group = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm_group');
            $type_immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_immeuble');
            $immeuble = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'imm');
            $etage = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'etage');
            $appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'n_appt');
            $type_appartement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_appt');
            $form = $this->createForm(new ApptType($imm_group, $type_immeuble, $immeuble, $etage, $appartement, $type_appartement), $appt);
            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();

                    $uow = $em->getUnitOfWork();
                    $uow->computeChangeSets();
                    $changeset = $uow->getEntityChangeSet($appt);
                    $em->persist($appt);
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('update', 'modification appt ID :'.$id, $id, $changeset, 'AmbAdherentBundle:Adhesion');

                    return $this->redirect( $this->generateUrl('ambadherent_listreservation') );
                }
            } 
            return $this->render('AmbAdherentBundle:Adhesion:modifier_appt.html.twig', array(
            'form' => $form->createView(),
            ));
        }
        return $this->redirect( $this->generateUrl('ambadherent_listreservation') );
    }
/*
    public function add_echeanceAction($id)
    {
        $repository_adhesion = $this->getDoctrine()
                                    ->getRepository('AmbAdherentBundle:Adhesion');
        $adhesion = $repository_adhesion->find($id);
        $form = $this->createForm(new EcheanceType(), $adhesion);
        if($adhesion != null)
        {   
            
            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($adhesion);
                    $em->flush();
                    $adherent = $adhesion->getAdherent();
                    return $this->redirect( $this->generateUrl('ambadherent_listadhesion', array(
                        'id' => $adherent->getId()
                    )));
                }
            }
            return $this->render('AmbAdherentBundle:Adhesion:ajouter_echeance.html.twig', array(
            'form' => $form->createView(),
            ));
        }

        return $this->render('AmbAdherentBundle:Adhesion:ajouter_echeance.html.twig', array(
        'form' => $form->createView(),
        ));

    }

    public function ajaxAction(Request $request)
    {
        $value = $request->get('term');

        // .... (Search values)
        $search = array('Bar', 'Foo');

        $response = new Response();
        $response->setContent(json_encode($search));

        return $response;
    }

*/

    public function count_reservationAction()
    {


        $rep_adh = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AmbAdherentBundle:Adhesion');
        $reservations = $rep_adh->CountReservation();
        return $this->render('AmbAdherentBundle:Adhesion:count_reservation.html.twig', array(
        'reservations' => $reservations,
        ));
    }  

    public function grandlivreAction($format)
    {
        $start = new \DateTime('2015-01-01');
        $end = new \DateTime('2015-03-31');
        $rep_adherent = $this->getDoctrine()
                             ->getRepository('AmbAdherentBundle:Adherent');
        $adherents = $rep_adherent->AdherentForGL($end);

        if ($format == 'pdf') {
            $html = $this->render('AmbAdherentBundle:Adhesion:grandlivre.pdf.twig', array(
                    'adherents' => $adherents,
                    'start' => $start,
                    'end' => $end,
                    'titre' => 'Situation globale des adherents'
                    ));
            $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($html->getContent());
            $html = $html2pdf->Output('gladhesions.pdf');
            $response = new Response();
            $response->clearHttpHeaders();
            $response->setContent(file_get_contents($html));
            $response->headers->set('Content-Type', 'application/force-download');
            $response->headers->set('Content-disposition', 'filename='. $html); 
            return $response;
        }else{
            return $this->render('AmbAdherentBundle:Adhesion:grandlivre.html.twig', array(
                    'adherents' => $adherents,
                    'start' => $start,
                    'end' => $end,
                    'titre' => 'Situation globale des adherents'
                    ));
        }
    }   
}