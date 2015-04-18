<?php

namespace Amb\CreditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\CreditBundle\Entity\Encaissement;
use Amb\AdherentBundle\Entity\Adhesion;
use Amb\CreditBundle\Form\EncaissementType;
use Amb\CreditBundle\Form\AutreEncaissementType;
use Amb\CreditBundle\Form\EncaissementValidationType;
use Amb\CreditBundle\Form\EncaissementFilterType;
use Amb\CreditBundle\Form\AutreEncaissementFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PHPExcel;
use PHPExcel_IOFactory;

class EncaissementController extends Controller
{

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_all_encaissAction($print = NULL)
    {
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
        $type_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');
        $annee_gestion = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'annee');
        $statut = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'statut');

        $form = $this->get('form.factory')->create(new EncaissementFilterType($mode_encaissement, $type_encaissement, $annee_gestion, $statut));

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();
            $mode_encaissement = $form->get('mode_encaissement')->getData();
            $banque = $form->get('banque')->getData();
            $type_encaissment = $form->get('type_encaissment')->getData();
            $annee_gestion = $form->get('annee_gestion')->getData();
            $matricule = $form->get('matricule')->getData();
            $statut = $form->get('statut')->getData();
            $mot_cle = $form->get('mot_cle')->getData();
            $repository_encaiss =   $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('AmbCreditBundle:Encaissement');
            //$filterBuilder = $repository_encaiss->createQueryBuilder('e');
            $em = $this->getDoctrine()->getEntityManager();
            /*$query = 'SELECT e, (SELECT d.matricule FROM AmbAdherentBundle:Desistement d WHERE d.adherent = e.adherent AND  d.adhesion = e.adhesion AND d.matricule <> (SELECT a.matricule FROM AmbAdherentBundle:Adhesion a WHERE a.id = e.adhesion) ) AS test 
                            FROM AmbCreditBundle:Encaissement e WHERE e.date_Operation BETWEEN \''.$date_debut->format('Y-m-d').'\' AND \''.$date_fin->format('Y-m-d').'\' ';*/
            $query = 'SELECT e
                            FROM AmbCreditBundle:Encaissement e WHERE e.date_Operation BETWEEN \''.$date_debut->format('Y-m-d').'\' AND \''.$date_fin->format('Y-m-d').'\' ';
            if($mode_encaissement  != null ) $query .= ' AND e.mode_encaissement = \''.$mode_encaissement.'\' ';
            if($type_encaissment  != null ) $query .= ' AND e.type_encaissment = \''.$type_encaissment.'\' ';
            if($banque  != null ) $query .= ' AND e.banque = \''.$banque->getId().'\' ';
            if($annee_gestion  != null ) $query .= ' AND e.annee_gestion = \''.$annee_gestion.'\' ';
            if($statut  != null ) $query .= ' AND e.statut = \''.$statut.'\' ';
            if($mot_cle  != null ) $query .= ' AND e.num_piece = \''.$mot_cle.'\' ';
            if($matricule  != null ) $query .= ' AND e.matricule = \''.$matricule.'\' ';
            $query .= ' ORDER BY e.date_Operation';
            $filterBuilder = $em->createQuery($query);

            $valid = $repository_encaiss->getSumStatutEncaissment2('valid');
            $invalid = $repository_encaiss->getSumStatutEncaissment2('invalid');
            $impayee = $repository_encaiss->getSumStatutEncaissment2('unpaid');
            //$this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $valid);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $invalid);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $impayee);
            $qb = $filterBuilder;
            //$qb->orderby('e.date_Operation');
            
            $valid = $valid->getQuery()->getSingleScalarResult();
            $invalid = $invalid->getQuery()->getSingleScalarResult();
            $impayee = $impayee->getQuery()->getSingleScalarResult();
            $encaissements = $qb->getResult();
            if ($print == 'print') {
                $html = $this->render('AmbCreditBundle:Encaissement:list_all_encaissement.pdf.twig', array(
                        'form' => $form->createView(), 
                        'encaissements' => $encaissements,
                        'date_debut' => $date_debut,
                        'date_fin' => $date_fin,
                        'statut' => $statut,
                        'valid' => $valid,
                        'invalid' => $invalid,
                        'impayee' => $impayee,
                    ));
                
                $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('ListEncaiss_'.$date_debut->format('d-m-Y').'_'.$date_fin->format('d-m-Y').'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
                return $this->render('AmbCreditBundle:Encaissement:list_all_encaissement.html.twig', array(
                    'form' => $form->createView(), 
                    'encaissements' => $encaissements,
                    'valid' => $valid,
                    'invalid' => $invalid,
                    'impayee' => $impayee,
                ));
            }
        }

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbCreditBundle:Encaissement');
        $encaissements = $repository->getAllEncaissment();   
        $valid = $repository->getSumStatutEncaissment('valid')->getQuery()->getSingleScalarResult();
        $invalid = $repository->getSumStatutEncaissment('invalid')->getQuery()->getSingleScalarResult();
        $impayee = $repository->getSumStatutEncaissment('unpaid')->getQuery()->getSingleScalarResult();
        
            return $this->render('AmbCreditBundle:Encaissement:list_all_encaissement.html.twig', array(
                'form' => $form->createView(), 
                'encaissements' => $encaissements,
                    'valid' => $valid,
                    'invalid' => $invalid,
                    'impayee' => $impayee,
            ));

    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_versementAction($appt, $type=null,  $print = NULL)
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbAdherentBundle:Adhesion');
        $repository_encaiss =   $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('AmbCreditBundle:Encaissement');
        if ($type=="desist") {
            $rep_desist = $this->getDoctrine()
                               ->getManager()
                               ->getRepository('AmbAdherentBundle:Desistement');
            $desistement = $rep_desist->find($appt);
            if($desistement == null )
            {
                throw $this->createNotFoundException('Desistement[N° '.$appt.'] inexistant.');
            } 

            $adherent = $desistement->getAdherent();
            $matricule = $desistement->getMatricule();
            $adhesion = $desistement->getAdhesion();

        }else{
            $adhesion = $repository->find($appt);
            if($adhesion === null)
            {
                return $this->redirect( $this->generateUrl('ambcredit_listallencaissement'));
            }
            $adherent = $adhesion->getAdherent();
            $matricule = $adhesion->getMatricule();
        }
        $encaissements = $repository_encaiss->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$matricule));                            
        //$encaissements = $adhesion->getEncaissements();
        if ($print == 'print') {
            $repository_encaiss =   $this->getDoctrine()
                                    ->getManager()
                                    ->getRepository('AmbCreditBundle:Encaissement');
            $valid = $repository_encaiss->getSumStatutEncaissment('valid',$adhesion)->getQuery()->getSingleScalarResult();
            $invalid = $repository_encaiss->getSumStatutEncaissment('invalid',$adhesion)->getQuery()->getSingleScalarResult();
            $impayee = $repository_encaiss->getSumStatutEncaissment('unpaid',$adhesion)->getQuery()->getSingleScalarResult();
            $html = $this->renderView('AmbCreditBundle:Encaissement:list_encaissement.pdf.twig', array(
                        'appt' => $appt,
                        'adherent' => $adherent,
                        'adhesion' => $adhesion,
                        'encaissements' => $encaissements,
                        'valid' => $valid,
                        'invalid' => $invalid,
                        'impayee' => $impayee,
                    ));
            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="SIT_VERSMNT_'.$adherent->getId().'.pdf"'
                )
            );
        }else{
            if ($type=="desist") {
                return $this->render('AmbCreditBundle:Encaissement:list_encaissement_desist.html.twig', array(
                            'desistement' => $desistement,
                            'encaissements' => $encaissements
                        ));
            }else{
                return $this->render('AmbCreditBundle:Encaissement:list_encaissement.html.twig', array(
                            'appt' => $appt,
                            'adherent' => $adherent,
                            'adhesion' => $adhesion,
                            'encaissements' => $encaissements
                        ));
            }
        }
    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function add_encaissementAction($appt, $action)
    {
        $adhesion = $this->getDoctrine()
                           ->getRepository('AmbAdherentBundle:Adhesion')
                           ->find($appt);

        if($adhesion != null)
        {   
            $encaissement = new encaissement();
            $adherent = $adhesion->getAdherent();

            $encaissement->setDateOperation(new \Datetime());
            $encaissement->setAdhesion($adhesion);  
            $encaissement->setAdherent($adherent);

            $ambexceldb = $this->container->get('amb_credit.ambexceldb');
            $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
            $type_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');

            $repository_enc = $this->getDoctrine()
                               ->getManager()
                               ->getRepository('AmbCreditBundle:Encaissement');

            
            $form = $this->createForm(new EncaissementType($mode_encaissement, $type_encaissement, 'add'), $encaissement);
            
            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($encaissement);
                    $encaissement->setStatut('invalid');
                    $encaissement->setMatricule($adhesion->getMatricule());
                    $em->flush();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('add', 'Ajouter encaissement ID :'.$encaissement->getId(), $encaissement->getId(), '', 'AmbCreditBundle:Encaissement');
                    
                    /*if($encaiss!=0){
                        $encaissement_impayee = $this->getDoctrine()
                                                     ->getRepository('AmbCreditBundle:Encaissement')
                                                     ->find($encaiss);
                        $encaissement_impayee->setNewEncaissement($encaissement->getId());
                        $em->flush();
                    }*/

                    //$encaissements = $repository_enc->findBy(array('adhesion'=>$adhesion, 'matricule'=>$adhesion->getMatricule()));
                    
                    if ($action=="new") {
                        return $this->redirect( $this->generateUrl('ambcredit_addversement', array(
                            'appt' => $appt
                        )));
                    }elseif ($action=="end") {
                        return $this->redirect( $this->generateUrl('ambcredit_listversement', array(
                        'appt' => $appt
                        )));
                    }
                }
            }

            return $this->render('AmbCreditBundle:Encaissement:add_encaissement.html.twig', array(
            'form' => $form->createView(),
            'appt' => $appt,
            'adhesion' => $adhesion,
            ));
        }
        
        return $this->redirect( $this->generateUrl('ambadherent_listadhesion'));
    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function update_encaissementAction($id)
    {
        $encaissement = $this->getDoctrine()
                       ->getRepository('AmbCreditBundle:Encaissement')
                       ->find($id);
        if($encaissement != null /*&& $encaissement->getQuitance() == null*/)
        {
            $ambexceldb = $this->container->get('amb_credit.ambexceldb');
            $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
            $type_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');

            $referer = $this->getRequest()->headers->get('referer');
            $form = $this->createForm(new EncaissementType($mode_encaissement, $type_encaissement, 'update', $referer), $encaissement);
            $request = $this->get('request');
            if( $request->getMethod() == 'POST' )
            {
                $form->bind($request);
                $backlink = $form->get('referer')->getData();
                if( $form->isValid() )
                {   
                    $em = $this->getDoctrine()->getEntityManager();

                    $uow = $em->getUnitOfWork();
                    $uow->computeChangeSets();
                    $changeset = $uow->getEntityChangeSet($encaissement);
                    $em->persist($encaissement);
                    $em->flush();
                    $adhesion = $encaissement->getAdhesion();
                    $traceability = $this->container->get('amb_trace.traceability');
                    $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');
                    
                    if (!is_null($backlink)) {
                        return $this->redirect($backlink);
                    }else{
                        return $this->redirect( $this->generateUrl('ambcredit_listversement', array(
                            'appt' => $adhesion->getId()
                        )));
                    }
                
                }
            }

            return $this->render('AmbCreditBundle:Encaissement:update_encaissement.html.twig', array(
            'form' => $form->createView(),
            'appt' => $encaissement->getAdhesion()->getId(),
            'adhesion' => $encaissement->getAdhesion(),
            )); 
        }

        if($encaissement == null || $encaissement->getQuitance() == null)
        {
            return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
        }  
        return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );            

    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function transfer_encaissementAction($id, $appt=null)
    {
        $rep_adherent = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adherent');
        $rep_adhesion = $this->getDoctrine()->getRepository('AmbAdherentBundle:Adhesion');
        $rep_encaiss = $this->getDoctrine()->getRepository('AmbCreditBundle:Encaissement');
        $encaiss_trans = $rep_encaiss->find($id);
        if($encaiss_trans == null )
        {
            throw $this->createNotFoundException('Encaissement[N° '.$id.'] inexistant.');
        } 
        if($appt != 0){
            $adhesion = $rep_adhesion->find($appt);

            if($adhesion == null || $adhesion->getAdherent() == null)
            {
                throw $this->createNotFoundException('Adhésion[N° '.$appt.'] inexistant.');
            } 
            $adherent= $adhesion->getAdherent();
            if($rep_encaiss->update_encaiss( null, null, $adherent, $adhesion, $id )){
                
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'transfere encaissement ID :'.$id, $id, '', 'AmbCreditBundle:Encaissement');

                return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
            }else{
                throw $this->createNotFoundException('Une erreur inconnue pendant le transfère d\'argent, veuillez contacter l\'administrateur du logiciel !!!');
            }
        }else{
            $adhesions = $rep_adhesion->findDetailAdhesionAll();
            return $this->render('AmbAdherentBundle:Adhesion:listappt_fortransfer.html.twig', array(
                'encaiss' => $encaiss_trans,
                'adhesions' => $adhesions
            ));
        }
    }

    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function voir_quitanceAction($id)
    {
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->findOneBy(array('n_quitance' => $id));
        if($encaissement != null)
        {  
            return $this->render('AmbCreditBundle:Quitance:pop_quitance.html.twig', array(
                        'encaissement' => $encaissement
                    ));
        }
        if($encaissement === null)
        {
            throw $this->createNotFoundException('Quitance[N° '.$id.'] inexistant.');
        }

    }


    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function delete_encaissementAction($id)
    {
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->find($id);
        if($encaissement != null)
        {  
            $adhesion = $encaissement->getAdhesion();
            $description = 'supprimer encaissement ID :'.$id.'
                            , Adherent :'.$encaissement->getadhesion()->getadherent()->getNomPrenom().'
                            , Adhesion : '.$encaissement->getadhesion()->getMatricule().'
                            , Montant : '.$encaissement->getMontant().'
                            , Mode : '.$encaissement->getModeEncaissement().'
                            , N° Pice : '.$encaissement->getNumPiece().'
                            ';
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($encaissement);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', $description, $id,'', 'AmbCreditBundle:Encaissement');
            return $this->redirect( $this->generateUrl('ambcredit_listversement', array(
                'appt' => $adhesion->getId()
            )));
        }
        if($encaissement === null)
        {
            throw $this->createNotFoundException('Encaissement[N° '.$id.'] inexistant.');
        }

    }


    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_AutrEncaissementAction($format=null)
    {
        $rep_enc = $this->getDoctrine()
                        ->getRepository('AmbCreditBundle:Encaissement');

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
        $source = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'source');
        $compte = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'compte_depense');
        
        $form = $this->get('form.factory')->create(new AutreEncaissementFilterType($mode_encaissement, $source, $compte));

            
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();
            $filterBuilder = $rep_enc->createQueryBuilder('a');
            $sum_encaiss = $rep_enc->getSumAutrEncaiss();
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $sum_encaiss);
            
            $qb = $filterBuilder;
            $qb->andwhere('a.source is not null');
            $qb->orderBy('a.date_Operation', 'DESC');

            $encaissements = $qb->getQuery()->getResult();
            $sum_encaiss = $sum_encaiss->getQuery()->getSingleScalarResult();

            if ($format == 'pdf') {
                $html = $this->render('AmbCreditBundle:Encaissement:list_autre_encaissement.pdf.twig', array(
                        'date_debut' => $date_debut,
                        'date_fin' => $date_fin,
                        'encaissements' => $encaissements,
                        'sum_encaiss' => $sum_encaiss
                    ));
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('ListEncaiss_'.$date_debut->format('d-m-Y').'_'.$date_fin->format('d-m-Y').'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
                return $this->render('AmbCreditBundle:Encaissement:list_autre_encaissement.html.twig', array(
                            'form' => $form->createView(),
                            'encaissements' => $encaissements,
                            'sum_encaiss' => $sum_encaiss
                        ));
            }
        }
        $encaissements = $rep_enc->findListAutrEncaissement();
        $sum_encaiss = $rep_enc->getSumAutrEncaiss();
        $sum_encaiss = $sum_encaiss->getQuery()->getSingleScalarResult();
        return $this->render('AmbCreditBundle:Encaissement:list_autre_encaissement.html.twig', array(
                            'form' => $form->createView(),
                            'encaissements' => $encaissements,
                            'sum_encaiss' => $sum_encaiss
                        ));

    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function ajouter_AutrEncaissementAction()
    {
        $encaissement = new Encaissement;

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
        $source = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'source');
        $compte = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'compte_depense');
            

        $form = $this->createForm(new AutreEncaissementType($mode_encaissement, $source, $compte), $encaissement);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $encaissement->setStatut('valid');
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($encaissement);
                $em->flush();
                
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter encaissement ID :'.$encaissement->getId(), $encaissement->getId(), '', 'AmbCreditBundle:Encaissement');
                
                return $this->redirect( $this->generateUrl('ambcredit_listotherversement') );
            }
        } 
        return $this->render('AmbCreditBundle:Encaissement:add_autre_encaissement.html.twig', array(
        'form' => $form->createView(),
        ));
    }


    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function update_AutrEncaissementAction($id)
    {
        $rep_enc = $this->getDoctrine()
                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $rep_enc->find($id);

        if($encaissement == null)
        {
            throw $this->createNotFoundException('Encaissement[N° '.$id.'] inexistant.');
        }

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_encaissement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_encaissement');
        $source = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'source');
        $compte = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'compte_depense');
            

        $form = $this->createForm(new AutreEncaissementType($mode_encaissement, $source, $compte), $encaissement);
        $request = $this->get('request');

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {

                $em = $this->getDoctrine()->getEntityManager();
                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($encaissement);
                $em->persist($encaissement);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');

                return $this->redirect( $this->generateUrl('ambcredit_listotherversement') );
            }
        }
        return $this->render('AmbCreditBundle:Encaissement:update_autre_encaissement.html.twig', array(
        'form' => $form->createView(),
        ));
    }


    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function delete_AutrEncaissementAction($id)
    {
        
        $rep_enc = $this->getDoctrine()
                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $rep_enc->find($id);

        if($encaissement == null)
        {
            throw $this->createNotFoundException('Encaissement[N° '.$id.'] inexistant.');
        } 
        $description = 'supprimer encaissement ID :'.$id.'
                        , Compte :'.$encaissement->getCompte().'
                        , Source : '.$encaissement->getSource().'
                        , Banque : '.$encaissement->getBanque()->getNom().'
                        , Montant : '.$encaissement->getMontant().'
                        , Mode : '.$encaissement->getModeEncaissement().'
                        , N° Pice : '.$encaissement->getNumPiece().'
                        ';
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($encaissement);
        $em->flush();
        $traceability = $this->container->get('amb_trace.traceability');
        $traceability->AddTraceability('delete', $description, $id,'', 'AmbCreditBundle:Encaissement');
        return $this->redirect( $this->generateUrl('ambcredit_listotherversement'));

    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function unpaid_encaissementAction($id)
    {
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->find($id);
        if($encaissement != null)
        {

            $referer = $this->getRequest()->headers->get('referer');
            if($encaissement->getNumPiece() != null){
                $list_pieces = $encaissement_repository->findBy(array(
                                                                'num_piece'=>$encaissement->getNumPiece(),
                                                                'adherent'=>$encaissement->getAdherent(),
                                                                'adhesion'=>$encaissement->getAdhesion(),
                                                                'date_Operation'=>$encaissement->getDateOperation()
                                                                ));
                if(count($list_pieces) > 1){
                    foreach ($list_pieces as $encaissement) {
                        $encaissement->SetStatut('unpaid');
                        $em = $this->getDoctrine()->getEntityManager();
                        $uow = $em->getUnitOfWork();
                        $uow->computeChangeSets();
                        $changeset = $uow->getEntityChangeSet($encaissement);
                        $em->persist($encaissement);
                        $em->flush();
                        $traceability = $this->container->get('amb_trace.traceability');
                        $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');
                        
                    }
                }
            }
            $encaissement->SetStatut('unpaid');
            $em = $this->getDoctrine()->getEntityManager();
            $uow = $em->getUnitOfWork();
            $uow->computeChangeSets();
            $changeset = $uow->getEntityChangeSet($encaissement);
            $em->persist($encaissement);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');
            
            return $this->redirect($referer);        
            //return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
        }

        if($encaissement == null)
        {
            return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
        }              

    }
    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function validation_encaissementAction($id)
    {
        $encaissement_repository = $this->getDoctrine()
                                        ->getRepository('AmbCreditBundle:Encaissement');
        $encaissement = $encaissement_repository->find($id);
        if($encaissement != null )
        {
            $referer = $this->getRequest()->headers->get('referer');
            if($encaissement->getNumPiece() != null){
                $list_pieces = $encaissement_repository->findBy(array(
                                                                'num_piece'=>$encaissement->getNumPiece(),
                                                                'adherent'=>$encaissement->getAdherent(),
                                                                'adhesion'=>$encaissement->getAdhesion(),
                                                                'date_Operation'=>$encaissement->getDateOperation()
                                                                ));
                if(count($list_pieces) > 1){
                    foreach ($list_pieces as $encaissement) {
                        $encaissement->SetStatut('valid');
                        $em = $this->getDoctrine()->getEntityManager();
                         $uow = $em->getUnitOfWork();
                        $uow->computeChangeSets();
                        $changeset = $uow->getEntityChangeSet($encaissement);
                        $em->persist($encaissement);
                        $em->flush();
                        $traceability = $this->container->get('amb_trace.traceability');
                        $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');
                        
                    }
                }
            }

            $encaissement->SetStatut('valid');
            $em = $this->getDoctrine()->getEntityManager();
             $uow = $em->getUnitOfWork();
            $uow->computeChangeSets();
            $changeset = $uow->getEntityChangeSet($encaissement);
            $em->persist($encaissement);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('update', 'modifier encaissement ID :'.$id, $id, $changeset, 'AmbCreditBundle:Encaissement');
            
            return $this->redirect($referer);
            //return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
        }    

        if($encaissement == null)
        {
            return $this->redirect( $this->generateUrl('ambcredit_listallencaissement') );
        } 


    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function list_pieceAction()
    {

    }
}
