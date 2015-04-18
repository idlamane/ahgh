<?php

namespace Amb\GlobalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\GlobalBundle\Form\JournalFilterType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Amb\GlobalBundle\Form\ProjetbudgetFilterType;

class GlobalController extends Controller
{
    /**
    * @Secure(roles="ROLE_DASHBOARD")
    */
    public function dashboardAction()
    {
        $global_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbGlobalBundle:Globaly');
        $AppartsParCout = $global_rep->AppartsParCout();
        $AppartsLibreParCout = $global_rep->AppartsLibreParCout();
        $situationappt = $global_rep->SumSituationApparts();
        $SituationConventions = $global_rep->SituationConventions();
        $SumSituationConvention = $global_rep->SumSituationConvention();
        
        return $this->render('AmbGlobalBundle:Global:dashboard.html.twig', array(
                'AppartsParCout' => $AppartsParCout,
                'AppartsLibreParCout' => $AppartsLibreParCout,
                'situationappt' => $situationappt,
                'SituationConventions' => $SituationConventions,
                'SumSituationConvention' => $SumSituationConvention,
                ));
    }
    /**
    * @Secure(roles="ROLE_DASHBOARD")
    */
    public function dashboard2Action($annee)
    {
        $global_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbGlobalBundle:Globaly');
        $EncaissementParMois = $global_rep->EncaissementParMois($annee);
        $SituationFinanciere = $global_rep->EncaissementDepenseParMois($annee);
        
        return $this->render('AmbGlobalBundle:Global:dashboard2.html.twig', array(
                'annee' => $annee,
                'EncaissementParMois' => $EncaissementParMois,
                'SituationFinanciere' => $SituationFinanciere,
                ));
    }
    /**
    * @Secure(roles="ROLE_DASHBOARD")
    */
    public function exerciceAction($format)
    {
        $global_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbGlobalBundle:Globaly');
        $depense_rep = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AmbDebitBundle:Depense');
        
        $form = $this->get('form.factory')->create(new ProjetbudgetFilterType());

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();


            $DepensesGestion = $depense_rep->ReparitionsDepense('GESTION', false);
            $DepensesAmort = $depense_rep->ReparitionsDepense('AMORTISSEMENT', false);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $DepensesGestion);
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $DepensesAmort);
            $DepensesGestion = $DepensesGestion->getQuery()->getResult();
            $DepensesAmort = $DepensesAmort->getQuery()->getResult();
            $RecetteCG = $global_rep->RecetteCompteGestion($date_debut, $date_fin);
            $TotRecetteCA = $global_rep->TotalRecetteAmmor($date_debut, $date_fin);
            $TotRecetteDivers = $global_rep->TotalRecetteCGDivers($date_debut, $date_fin);
            $TotRecetteCG = $global_rep->TotalRecetteCompteGestion($date_debut, $date_fin);
            $TotDepenseCG = $global_rep->TotalDepense('GESTION', $date_debut, $date_fin);
            $TotDepenseCA = $global_rep->TotalDepense('AMORTISSEMENT', $date_debut, $date_fin);

            if ($format == 'pdf') {
                $html = $this->render('AmbGlobalBundle:Global:exercice.pdf.twig', array(
                    'form' => $form->createView(),
                    'DepensesGestion' => $DepensesGestion,
                    'DepensesAmort' => $DepensesAmort,
                    'RecetteCG' => $RecetteCG,
                    'TotRecetteCA' => $TotRecetteCA,
                    'TotRecetteDivers' => $TotRecetteDivers,
                    'TotRecetteCG' => $TotRecetteCG,
                    'TotDepenseCG' => $TotDepenseCG,
                    'TotDepenseCA' => $TotDepenseCA,
                    'date_debut' => $date_debut,
                    'date_fin' => $date_fin,
                    ));
                
                $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('EXERCICE_'.$date_debut->format('d-m-Y').'_'.$date_fin->format('d-m-Y').'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
                return $this->render('AmbGlobalBundle:Global:exercice.html.twig', array(
                    'form' => $form->createView(),
                    'DepensesGestion' => $DepensesGestion,
                    'DepensesAmort' => $DepensesAmort,
                    'RecetteCG' => $RecetteCG,
                    'TotRecetteCA' => $TotRecetteCA,
                    'TotRecetteDivers' => $TotRecetteDivers,
                    'TotRecetteCG' => $TotRecetteCG,
                    'TotDepenseCG' => $TotDepenseCG,
                    'TotDepenseCA' => $TotDepenseCA,
                    ));
            }

        }

        $DepensesGestion = $depense_rep->ReparitionsDepense('GESTION', true);
        $DepensesAmort = $depense_rep->ReparitionsDepense('AMORTISSEMENT', true);
        $DepensesGestion = $DepensesGestion->getQuery()->getResult();
        $DepensesAmort = $DepensesAmort->getQuery()->getResult();
        $RecetteCG = $global_rep->RecetteCompteGestion();
        $TotRecetteCA = $global_rep->TotalRecetteAmmor();
        $TotRecetteDivers = $global_rep->TotalRecetteCGDivers();
        $TotRecetteCG = $global_rep->TotalRecetteCompteGestion();
        $TotDepenseCG = $global_rep->TotalDepense('GESTION');
        $TotDepenseCA = $global_rep->TotalDepense('AMORTISSEMENT');
        return $this->render('AmbGlobalBundle:Global:exercice.html.twig', array(
                'form' => $form->createView(),
                'DepensesGestion' => $DepensesGestion,
                'DepensesAmort' => $DepensesAmort,
                'RecetteCG' => $RecetteCG,
                'TotRecetteCA' => $TotRecetteCA,
                'TotRecetteDivers' => $TotRecetteDivers,
                'TotRecetteCG' => $TotRecetteCG,
                'TotDepenseCG' => $TotDepenseCG,
                'TotDepenseCA' => $TotDepenseCA,
                ));
    }
    /**
    * @Secure(roles="ROLE_CONSULT")
    */
    public function ProjetBudgetAction($print)
    {
        $global_rep = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbGlobalBundle:Globaly');

        $form = $this->get('form.factory')->create(new ProjetbudgetFilterType());

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData();
            $date_fin = $form->get('date_fin')->getData();
            $ResteDesist = $global_rep->TotalResteDesistement();
            $TotalRestitution = $global_rep->TotalRestitution();
            $RecetteCG = $global_rep->RecetteCompteGestion($date_debut, $date_fin);
            $TotRecetteDivers = $global_rep->TotalRecetteCGDivers($date_debut, $date_fin);
            $TotRecetteAMDivers = $global_rep->TotalRecetteAMDivers($date_debut, $date_fin);
            $TotRecetteCG = $global_rep->TotalRecetteCompteGestion($date_debut, $date_fin);
            $TotDepenseCG = $global_rep->TotalDepense('GESTION', $date_debut, $date_fin);
            $TotRecetteCA = $global_rep->TotalRecetteAmmor($date_debut, $date_fin);
            $TotDepenseCA = $global_rep->TotalDepense('AMORTISSEMENT', $date_debut, $date_fin);
            if ($print == 'print') {
                $html = $this->render('AmbGlobalBundle:Global:projetbudget.pdf.twig', array(
                        'form' => $form->createView(), 
                        'ResteDesist' => $ResteDesist, 
                        'TotalRestitution' => $TotalRestitution, 
                        'date_debut' => $date_debut,
                        'date_fin' => $date_fin,
                        'RecetteCG' => $RecetteCG,
                        'TotRecetteCG' => $TotRecetteCG,
                        'TotRecetteDivers' => $TotRecetteDivers,
                        'TotRecetteAMDivers' => $TotRecetteAMDivers,
                        'TotDepenseCG' => $TotDepenseCG,
                        'TotRecetteCA' => $TotRecetteCA,
                        'TotDepenseCA' => $TotDepenseCA,
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
                return $this->render('AmbGlobalBundle:Global:projetbudget.html.twig', array(
                    'form' => $form->createView(), 
                    'ResteDesist' => $ResteDesist,
                    'TotalRestitution' => $TotalRestitution,
                    'RecetteCG' => $RecetteCG,
                    'TotRecetteCG' => $TotRecetteCG,
                    'TotRecetteDivers' => $TotRecetteDivers,
                    'TotRecetteAMDivers' => $TotRecetteAMDivers,
                    'TotDepenseCG' => $TotDepenseCG,
                    'TotRecetteCA' => $TotRecetteCA,
                    'TotDepenseCA' => $TotDepenseCA,
                ));
            }
        }
        $ResteDesist = $global_rep->TotalResteDesistement(); 
        $TotalRestitution = $global_rep->TotalRestitution();                  
        $RecetteCG = $global_rep->RecetteCompteGestion();
        $TotRecetteCG = $global_rep->TotalRecetteCompteGestion();
        $TotRecetteDivers = $global_rep->TotalRecetteCGDivers();
        $TotRecetteAMDivers = $global_rep->TotalRecetteAMDivers();
        $TotDepenseCG = $global_rep->TotalDepense('GESTION');
        $TotRecetteCA = $global_rep->TotalRecetteAmmor();
        $TotDepenseCA = $global_rep->TotalDepense('AMORTISSEMENT');
        
        return $this->render('AmbGlobalBundle:Global:projetbudget.html.twig', array(
                'form' => $form->createView(),  
                'ResteDesist' => $ResteDesist,
                'TotalRestitution' => $TotalRestitution,
                'RecetteCG' => $RecetteCG,
                'TotRecetteCG' => $TotRecetteCG,
                'TotRecetteDivers' => $TotRecetteDivers,
                'TotRecetteAMDivers' => $TotRecetteAMDivers,
                'TotDepenseCG' => $TotDepenseCG,
                'TotRecetteCA' => $TotRecetteCA,
                'TotDepenseCA' => $TotDepenseCA,
                ));
    }

    /**
    * @Secure(roles="ROLE_RECOVRING")
    */
    public function JournalTransactionAction($print)
    {
        $journal_repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository('AmbGlobalBundle:Globaly');
        
        $form = $this->get('form.factory')->create(new JournalFilterType());

        $request = $this->get('request');
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            $date_debut = $form->get('date_debut')->getData()->format('d-m-Y');
            $date_fin = $form->get('date_fin')->getData()->format('d-m-Y');
            $mot_cle = $form->get('mot_cle')->getData();
            $banque = $form->get('banque')->getData();
            $mode = $form->get('mode')->getData();
            $adh = $form->get('adh')->getData();
            $journals=$journal_repository->JournalTransaction(new \Datetime($date_debut), new \Datetime($date_fin), $banque, $mot_cle, $adh, $mode );
            $totals=$journal_repository->SumMouvement(new \Datetime($date_debut), new \Datetime($date_fin), $banque, $mot_cle, $adh, $mode );
            
           
            if ($print == 'print') {
                $html = $this->render('AmbGlobalBundle:Global:journal_tresorerie.pdf.twig', array(
                        'form' => $form->createView(), 
                        'journals' => $journals,
                        'date_debut' => $date_debut,
                        'date_fin' => $date_fin,
                        'totals' => $totals
                    ));
                /*return new Response(
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                    200,
                    array(
                        'Content-Type'          => 'application/pdf',
                        'Content-Disposition'   => 'attachment; filename="amb.pdf"'
                    )
                );*/
                $html2pdf = new \Html2Pdf_Html2Pdf('L','A4','fr');
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->writeHTML($html->getContent());
                $html = $html2pdf->Output('JT_'.$date_debut.'_'.$date_fin.'.pdf');
                $response = new Response();
                $response->clearHttpHeaders();
                $response->setContent(file_get_contents($html));
                $response->headers->set('Content-Type', 'application/force-download');
                $response->headers->set('Content-disposition', 'filename='. $html); 
                return $response;
            }else{
                return $this->render('AmbGlobalBundle:Global:journal_tresorerie.html.twig', array(
                    'form' => $form->createView(), 
                    'journals' => $journals,
                    'totals' => $totals
                ));
            }
        }
        $journals = $journal_repository->JournalTransaction(new \Datetime('01-01-'.date('Y')), new \Datetime('31-12-'.date('Y')));
        $totals=$journal_repository->SumMouvement(new \Datetime('01-01-'.date('Y')), new \Datetime('31-12-'.date('Y')));

        return $this->render('AmbGlobalBundle:Global:journal_tresorerie.html.twig', array(
            'form' => $form->createView(), 
            'journals' => $journals,
            'totals' => $totals
        ));
    }




    /*
    public function SumEncaissement(){
        $conn = $this->container->get('database_connection');
        $sql = 'SELECT MONTHNAME(date_Operation) AS mois, SUM(montant) AS somm
                FROM encaissement WHERE YEAR(date_Operation) = YEAR(CURRENT_DATE()) AND statut = "valid"
                GROUP BY MONTHNAME(date_Operation) ORDER BY date_Operation';
        return $conn->query($sql);      
    }

    public function SumTransaction(){
        $conn = $this->container->get('database_connection');
        $sql = 'SELECT *, MONTHNAME(date_Operation) AS mois, SUM(encaissement) AS encaissements, SUM(depense) AS depenses
                FROM mouvement WHERE YEAR(date_Operation) = YEAR(CURRENT_DATE())
                GROUP BY mois
                ORDER BY date_Operation';
        return $conn->query($sql);      
    }

    public function JournalTransaction($date_debut, $date_fin, $banque = null, $mot_cle = null ){
        $conn = $this->container->get('database_connection');
        $sql = 'SELECT *  From mouvement
                WHERE ( mouvement.date_Operation BETWEEN \''.$date_debut->format('Y-m-d').'\' AND \''.$date_fin->format('Y-m-d').'\') 
                AND ( mouvement.piece LIKE \'%'.$mot_cle.'%\' OR mouvement.libelle LIKE \'%'.$mot_cle.'%\') ';
        if ($banque != null) {
            $sql .= ' AND mouvement.banque_id = '.$banque.' ';
        }
        $sql .= ' ORDER BY mouvement.date_Operation ASC';
        return $conn->query($sql);  
    }

    public function TotalTransaction($date_debut, $date_fin, $banque = null, $mot_cle = null ){
        $conn = $this->container->get('database_connection');
        $sql = 'SELECT SUM(encaissement) as total_enc From mouvement INNER JOIN banque ON mouvement.banque = banque.id
                WHERE ( mouvement.date_Operation BETWEEN \''.$date_debut->format('Y-m-d').'\' AND \''.$date_fin->format('Y-m-d').'\') 
                AND ( mouvement.piece LIKE \'%'.$mot_cle.'%\' OR mouvement.libelle LIKE \'%'.$mot_cle.'%\') ';
        if ($banque != null) {
            $sql .= ' AND mouvement.banque = '.$banque.' ';
        }
        return $conn->query($sql);  
    }*/
}
