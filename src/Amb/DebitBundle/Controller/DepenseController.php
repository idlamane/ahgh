<?php

namespace Amb\DebitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\DebitBundle\Entity\Depense;
use Amb\DebitBundle\Form\DepenseType;
use Amb\DebitBundle\Form\DepenseDesistementType;
use Amb\DebitBundle\Form\DepenseFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PHPExcel;
use PHPExcel_IOFactory;

class DepenseController extends Controller
{
    
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function consult_depenseAction($id)
    {

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Depense');


        $depense = $repository->find($id);

        if($depense === null)
        {
            throw $this->createNotFoundException('Dépense [id='.$id.'] inexistant.');
        }    

        return $this->render('AmbDebitBundle:Depense:consult_depense.html.twig', array(
            'depense' => $depense,
        ));
    }
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function list_depenseAction($print, $type=null)
    {
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');

        $form = $this->get('form.factory')->create(new DepenseFilterType($type, $mode_retrait));

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();
            $depense_repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Depense');
          
            $filterBuilder = $depense_repository->createQueryBuilder('e');
            $sum_depense = $depense_repository->getSumDepenses($type);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $sum_depense);

            $qb = $filterBuilder->leftJoin('e.typedepense', 't')
                 ->addSelect('t.compte');
            $qb = $filterBuilder->leftJoin('e.fournisseur', 'f')
                 ->addSelect('f.raison_social');
            if($type=="gestion")$compte="GESTION";
            elseif($type=="amortissement")$compte="AMORTISSEMENT";
            if($type=="gestion"){
                $qb->andwhere('e.desistement is null AND e.adherent is null AND (t.compte=:compte OR t.compte is null)')
                     ->setParameters(array('compte' => $compte));
            }elseif($type=="amortissement"){
                $qb->andwhere('e.desistement is null AND e.adherent is null AND t.compte=:compte')
                     ->setParameters(array('compte' => $compte));
            }else{
                $qb->andwhere('e.desistement is null AND e.adherent is null ');
            }

            $qb->orderby('e.date_operation');


            $depenses = $qb->getQuery()->getResult();
            $sum_depense = $sum_depense->getQuery()->getSingleScalarResult();
            

            if ($print == 'print') {
                $html = $this->render('AmbDebitBundle:Depense:list_depense.pdf.twig', array(
                        'depenses' => $depenses,
                        'date_debut' => $date_debut,
                        'date_fin' => $date_fin,
                        'sum_depense' => $sum_depense,
                        'type' => $type
                    ));
                $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('ListDepense_'.$date_debut->format('d-m-Y').'_'.$date_fin->format('d-m-Y').'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
                return $this->render('AmbDebitBundle:Depense:list_depense.html.twig', array(
                        'form' => $form->createView(), 
                        'type' => $type,
                        'depenses' => $depenses,
                        'sum_depense' => $sum_depense,
                    ));
            }
        }

        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbDebitBundle:Depense');
        $depenses = $repository->getDepenseAvecTypeAll($type);
        $sum_depense = $repository->getSumDepenses_nofilter($type)->getQuery()->getSingleScalarResult();
        

        return $this->render('AmbDebitBundle:Depense:list_depense.html.twig', array(
                'form' => $form->createView(), 
                'type' => $type,
                'depenses' => $depenses,
                'sum_depense' => $sum_depense
            ));
    }

    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function alimenter_caisseAction()
    {
        $type = 'caisse';
        $depense = new Depense;

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');

        $form = $this->createForm(new DepenseType(array("mode_retrait" => $mode_retrait, "type" => $type)), $depense);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $depense->SetCaisse(1);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($depense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter depense ID :'.$depense->getId(), $depense->getId(), '', 'AmbDebitBundle:Depense');
                return $this->redirect( $this->generateUrl('ambdepense_accueil') );
            }
        } 
            return $this->render('AmbDebitBundle:Depense:alimenter_caisse.html.twig', array(
            'form' => $form->createView()
            ));

    }

    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function add_depenseAction($type, $frs=null, $action)
    {
        $depense = new Depense;

        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');

        $form = $this->createForm(new DepenseType(array("mode_retrait" => $mode_retrait, "type" => $type, "frs" => $frs)), $depense);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($depense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('add', 'Ajouter depense ID :'.$depense->getId(), $depense->getId(), '', 'AmbDebitBundle:Depense');
                

                if ($action=="new") {
                    if ($frs != null) {
                        return $this->redirect( $this->generateUrl('ambdepense_ajouter', array(
                            'type' => $type,
                            'frs' => $frs,
                            )));
                    }elseif($type == "gestion" || $type == "amortissement"){
                        return $this->redirect( $this->generateUrl('ambdepense_ajouter', array(
                            'type' => $type
                            )));
                    }
                }elseif ($action=="end") {
                    if ($frs != null) {
                    return $this->redirect( $this->generateUrl('ambcontrat_list') );
                    }elseif($type == "gestion" || $type == "amortissement"){
                        return $this->redirect( $this->generateUrl('ambdepense_accueil', array(
                            'type' => $type
                            )));
                    }else{
                        return $this->redirect( $this->generateUrl('ambdepense_accueil') );
                    }
                }


                
                
            }
        } 
            return $this->render('AmbDebitBundle:Depense:add_depense.html.twig', array(
            'form' => $form->createView(),
            'frs' => $frs,
            'type' => $type
            ));

    }


    /**
    * @Secure(roles="ROLE_COMPTA")
    */
    public function update_depenseAction($id)
    {
        $depense = $this->getDoctrine()
                        ->getRepository('AmbDebitBundle:Depense')
                        ->find($id);

        if($depense == null)
        {
            return $this->redirect( $this->generateUrl('ambdepense_accueil') );
        }
        $typedepense = $depense->getTypedepense();               
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');
        $referer = $this->getRequest()->headers->get('referer');
        if ($typedepense != null) {
            if($typedepense->getCompte() == 'GESTION'){
                $type='gestion';
                $form = $this->createForm(new DepenseType(array("mode_retrait" => $mode_retrait, "type" => $type, "referer" => $referer)), $depense);
            }elseif ($typedepense->getCompte() == 'AMORTISSEMENT'){
                $type='amortissement';
                $form = $this->createForm(new DepenseType(array("mode_retrait" => $mode_retrait, "type" => $type, "referer" => $referer)), $depense);
            }
        }elseif ($depense->getCaisse() != null){
                $type='caisse';
            $form = $this->createForm(new DepenseType(array("mode_retrait" => $mode_retrait, "type" => $type, "referer" => $referer)), $depense);
        }
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
                $changeset = $uow->getEntityChangeSet($depense);
                $em->persist($depense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier depense ID :'.$id, $id, $changeset, 'AmbDebitBundle:Depense');
                
                    if (!is_null($backlink)) {
                        return $this->redirect($backlink);
                    }else{
                        return $this->redirect( $this->generateUrl('ambdepense_accueil') );
                    }
            }
        }
        return $this->render('AmbDebitBundle:Depense:update_depense.html.twig', array(
        'form' => $form->createView(),
        'type' => $type,
        ));
    }

    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function delete_depenseAction($id)
    {
        $depense_repository = $this->getDoctrine()
                                       ->getRepository('AmbDebitBundle:Depense');
        $depense = $depense_repository->find($id);
        if($depense != null)
        {  
            $description = 'supprimer depense ID :'.$id.'
                            , Mode :'.$depense->getModeRetrait().'
                            , libelle :'.$depense->getLibelle().'
                            , Montant : '.$depense->getMontant().'
                            , N° Pice : '.$depense->getNPiece().'
                            , Banque : '.$depense->getBanque()->getNom().'
                            ';
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($depense);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', $description, $id,'', 'AmbDebitBundle:Depense');
            return $this->redirect( $this->generateUrl('ambdepense_accueil'));
        }
        if($depense === null)
        {
            throw $this->createNotFoundException('Dépense [N° '.$id.'] inexistant.');
        }

    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function add_remboursementAction($type, $id)
    {
        
        if ($type=="desist") {
            $rep_desist =   $this->getDoctrine()
                                         ->getManager()
                                         ->getRepository('AmbAdherentBundle:Desistement');
            $desistement = $rep_desist->find($id);
            if (!empty($desistement)) {
                
                $depense = new Depense;
                $depense->setDateOperation(new \Datetime());

                $ambexceldb = $this->container->get('amb_credit.ambexceldb');
                $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');
                $type_remboursement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');
                $annee = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'annee');

                $form = $this->createForm(new DepenseDesistementType($mode_retrait, $type_remboursement, $annee ), $depense);
                $request = $this->get('request');
                if( $request->getMethod() == 'POST' )
                {
                    $form->bind($request);
                    if( $form->isValid() )
                    {  
                        $em = $this->getDoctrine()->getEntityManager();
                        $depense->setDesistement($desistement);
                        $depense->setAdherent($desistement->getAdherent());
                        $depense->setAdhesion($desistement->getAdhesion());
                        $depense->setMatricule($desistement->getMatricule());
                        $em->persist($depense);

                        $em->flush();
                    }
                return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
                }
                return $this->render('AmbDebitBundle:Depense:add_rembour.html.twig', array(
                'form' => $form->createView(),
                'type'=>$type,
                ));
            }
        }else{
            $rep_adhesion =   $this->getDoctrine()
                                         ->getManager()
                                         ->getRepository('AmbAdherentBundle:Adhesion');
            $adhesion = $rep_adhesion->find($id);
            if (!empty($adhesion)) {
                
                $depense = new Depense;
                $depense->setDateOperation(new \Datetime());

                $ambexceldb = $this->container->get('amb_credit.ambexceldb');
                $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');
                $type_remboursement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');
                $annee = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'annee');

                $form = $this->createForm(new DepenseDesistementType($mode_retrait, $type_remboursement, $annee ), $depense);
                $request = $this->get('request');
                if( $request->getMethod() == 'POST' )
                {
                    $form->bind($request);
                    if( $form->isValid() )
                    {  
                        $em = $this->getDoctrine()->getEntityManager();
                        //$depense->setDesistement($desistement);
                        $depense->setAdherent($adhesion->getAdherent());
                        $depense->setAdhesion($adhesion);
                        $depense->setMatricule($adhesion->getMatricule());
                        $em->persist($depense);

                        $em->flush();
                    }
                return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
                }
                return $this->render('AmbDebitBundle:Depense:add_rembour.html.twig', array(
                'form' => $form->createView(),
                ));
            }
        }
    }

    /**
    * @Secure(roles="ROLE_OPERATOR")
    */
    public function update_remboursementAction($id)
    {
        $rep_depense =   $this->getDoctrine()
                             ->getManager()
                             ->getRepository('AmbDebitBundle:Depense');
        $depense = $rep_depense->find($id);

        if($depense === null)
        {
            throw $this->createNotFoundException('Depense[N° '.$id.'] inexistant.');
        }
        $ambexceldb = $this->container->get('amb_credit.ambexceldb');
        $mode_retrait = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'mode_retrait');
        $type_remboursement = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'type_encaissement');
        $annee = $ambexceldb->get_FromAmbExcelDB($this->get('xls.load_xls5'), 'annee');

        $form = $this->createForm(new DepenseDesistementType($mode_retrait, $type_remboursement, $annee ), $depense);
        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if( $form->isValid() )
            {   
                $em = $this->getDoctrine()->getEntityManager();

                $uow = $em->getUnitOfWork();
                $uow->computeChangeSets();
                $changeset = $uow->getEntityChangeSet($depense);
                $em->persist($depense);
                $em->flush();
                $traceability = $this->container->get('amb_trace.traceability');
                $traceability->AddTraceability('update', 'modifier depense ID :'.$id, $id, $changeset, 'AmbDebitBundle:Depense');
                return $this->redirect( $this->generateUrl('ambadherent_listadhesion'));
            }
        }

        return $this->render('AmbDebitBundle:Depense:update_depense.html.twig', array(
        'form' => $form->createView(),
        )); 


    }


    /**
    * @Secure(roles="ROLE_MANAGER")
    */
    public function delete_remboursementAction($id)
    {
        $rep_depense =   $this->getDoctrine()
                             ->getManager()
                             ->getRepository('AmbDebitBundle:Depense');
        $depense = $rep_depense->find($id);

        if($depense === null)
        {
            throw $this->createNotFoundException('Depense[N° '.$id.'] inexistant.');
        }
            $adhesion = $depense->getAdhesion();
            $description = 'supprimer remboursement ID :'.$id.'
                            , Adherent :'.$depense->getadhesion()->getadherent()->getNomPrenom().'
                            , Adhesion : '.$depense->getMatricule().'
                            , matricule : '.$depense->getMatricule().'
                            , Montant : '.$depense->getMontant().'
                            , Mode : '.$depense->getModeRetrait().'
                            , N° Piece : '.$depense->getNPiece().'
                            ';
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($depense);
            $em->flush();
            $traceability = $this->container->get('amb_trace.traceability');
            $traceability->AddTraceability('delete', $description, $id,'', 'AmbDebitBundle:Depense');
            return $this->redirect( $this->generateUrl('ambadherent_listadhesion'));

    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function list_remboursementAction($id, $type = null, $format = NULL)
    {
        if ($type=="desist") {
            $repository = $this->getDoctrine()
                               ->getManager()
                               ->getRepository('AmbAdherentBundle:Desistement');
            $desistement = $repository->find($id);

            if($desistement === null)
            {
                return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
            }
            $adherent = $desistement->getAdherent();
            $adhesion = $desistement->getAdhesion();
            $matricule = $desistement->getMatricule();
            $repository_depense =   $this->getDoctrine()
                                        ->getManager()
                                        ->getRepository('AmbDebitBundle:Depense');
            $depenses = $repository_depense->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$matricule));                            
            //$encaissements = $adhesion->getEncaissements();
            if ($format == 'pdf') {
                $html = $this->renderView('AmbDebitBundle:Depense:list_remboursement.pdf.twig', array(
                            'id' => $id,
                                'adherent' => $adherent,
                                'desistement' => $desistement,
                                'depenses' => $depenses
                        ));
                return new Response(
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                    200,
                    array(
                        'Content-Type'          => 'application/pdf',
                        'Content-Disposition'   => 'attachment; filename="SIT_REMBSNT_'.$adherent->getId().'.pdf"'
                    )
                );
            }else{
                return $this->render('AmbDebitBundle:Depense:list_remboursement.html.twig', array(
                                'id' => $id,
                                'adherent' => $adherent,
                                'desistement' => $desistement,
                                'depenses' => $depenses
                            ));
            }
        }else{
            $repository = $this->getDoctrine()
                               ->getManager()
                               ->getRepository('AmbAdherentBundle:adhesion');
            $adhesion = $repository->find($id);

            if($adhesion === null)
            {
                return $this->redirect( $this->generateUrl('ambadherent_listdesistement') );
            }
            $adherent = $adhesion->getAdherent();
            $matricule = $adhesion->getMatricule();
            $repository_depense =   $this->getDoctrine()
                                        ->getManager()
                                        ->getRepository('AmbDebitBundle:Depense');
            $depenses = $repository_depense->findBy(array('adhesion'=>$adhesion, 'adherent'=>$adherent, 'matricule'=>$matricule));                            
            //$encaissements = $adhesion->getEncaissements();
            if ($format == 'pdf') {
                $html = $this->renderView('AmbDebitBundle:Depense:list_remboursement.pdf.twig', array(
                            'id' => $id,
                                'adherent' => $adherent,
                                'adhesion' => $adhesion,
                                'depenses' => $depenses
                        ));
                return new Response(
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                    200,
                    array(
                        'Content-Type'          => 'application/pdf',
                        'Content-Disposition'   => 'attachment; filename="SIT_REMBSNT_'.$adherent->getId().'.pdf"'
                    )
                );
            }else{
                return $this->render('AmbDebitBundle:Depense:list_remboursement.html.twig', array(
                                'id' => $id,
                                'adherent' => $adherent,
                                'adhesion' => $adhesion,
                                'depenses' => $depenses
                            ));
            }

        }
        
    }

}