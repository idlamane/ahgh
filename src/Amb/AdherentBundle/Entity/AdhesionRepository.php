<?php

namespace Amb\AdherentBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class AdhesionRepository extends EntityRepository
{
	public function ApptIsLibre($imm_group, $immeuble,$appartement){
		$qb = $this->createQueryBuilder('a');
		/*$qb->add('select', 'COUNT(a)')
		   ->add('from', 'AmbAdherentBundle:Adhesion a');*/
	    // On peut rajouter ce qu'on veut avant
	    $qb->where('a.imm_group = :imm_group AND a.immeuble = :immeuble AND a.appartement = :appartement')
	         ->setParameters(array('imm_group' => $imm_group, 
	         					   'immeuble' => $immeuble,
	         					   'appartement' => $appartement
	         					   ));    
	    
	    return $qb->getQuery()->getOneOrNullResult();			
	}

	public function ApptforDesist($adherent ,$adhesion){
		$qb = $this->createQueryBuilder('a');
	    $qb->where('a.adherent = :adherent AND a.id <> :adhesion')
	         ->setParameters(array('adherent' => $adherent, 
	         					   'adhesion' => $adhesion
	         					   ));    
	    
	    return $qb->getQuery()
	              ->getResult();			
	}

	

	public function findDetailByAdhesion($adhesion){
		$connection = $this->getEntityManager()->getConnection();
	    $q = 'SELECT * FROM situation_appt WHERE id= '.$adhesion;
	    return $connection->executeQuery($q)->fetch();
	}
	/*
	public function findDetailByAdhesion($adhesion){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a detail, 
							SUM(e.montant) totalversement,
							((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) cout_global,
							100*SUM(e.montant)/((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) avancement')
		   ->add('from', 'AmbAdherentBundle:Adhesion a')
	  	   ->leftJoin('a.encaissements', 'e', 'WITH', 'e.type_encaissment = :versement AND e.statut = :statut AND e.adherent = a.adherent')
	  	   ->addSelect('e')
	  	   ->leftJoin('a.adherent', 'd')
	  	   ->addSelect('d');
	    // On peut rajouter ce qu'on veut avant
	    $qb->where('a.id = :adhesion')
	         ->setParameters(array('versement' => 'VERSEMENT' , 'statut' => 'valid' , 'adhesion' => $adhesion));
	    // On peut rajouter ce qu'on veut après
	    $qb->groupBy('a.id');
	    
	    return $qb->getQuery()
	              ->getSingleResult();				
	}*/


	public function findDetailByAdherent($adherent){
		$connection = $this->getEntityManager()->getConnection();
	    $q = 'SELECT * FROM situation_appt WHERE adherent= '.$adherent;
	    return $connection->executeQuery($q);
	}
	/*
	public function findDetailByAdherent($adherent){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a detail,
							SUM(e.montant) totalversement, 
							((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) cout_global,
							100*SUM(e.montant)/((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) avancement')
		   ->add('from', 'AmbAdherentBundle:Adhesion a')
	  	   ->leftJoin('a.encaissements', 'e', 'WITH', 'e.type_encaissment = :versement AND e.statut = :statut AND e.adherent = a.adherent')
	  	   ->addSelect('e')
	  	   ->leftJoin('a.adherent', 'd')
	  	   ->addSelect('d');
	    // On peut rajouter ce qu'on veut avant
	    $qb->where(' a.adherent = :adherent')
	         ->setParameters(array('versement' => 'VERSEMENT', 'statut' => 'valid', 'adherent' => $adherent));
	    // On peut rajouter ce qu'on veut après
	    $qb->groupBy('a.id');
	    
	    return $qb->getQuery()
	              ->getResult();				
	}
	*/

	public function findDetailAdhesionAll($type_immeuble = null,
                            $immeuble = null,
                            $etage = null,
                            $type_appartement = null,
                            $imm_group = null,
                            $dossier = null,
                            $matricule = null,
                            $versement = null,
                            $appartement=null,
                            $surface_appt=null,
                            $adh_solde=null,
                            $pourcentage = null){
		
		switch ($pourcentage) {
		    case 1:
		        $pourcentage_rq = " AND pourcent_vers_port <50";
		        break;
		    case 2:
		        $pourcentage_rq = "AND (pourcent_vers_port<60 AND pourcent_vers_port>49)";
		        break;
		    case 3:
		        $pourcentage_rq = "AND (pourcent_vers_port<70 AND pourcent_vers_port>59)";
		        break;
		    case 4:
		        $pourcentage_rq = "AND (pourcent_vers_port<80 AND pourcent_vers_port>69)";
		        break;
		    case 5:
		        $pourcentage_rq = "AND (pourcent_vers_port<90 AND pourcent_vers_port>79)";
		        break;
		    case 6:
		        $pourcentage_rq = "AND (pourcent_vers_port<100 AND pourcent_vers_port>89)";
		        break;
		    case 7:
		        $pourcentage_rq = "AND pourcent_vers_port=100 ";
		        break;
		}
		switch ($adh_solde) {
		    case 1:
		        $adh_solde_rq = " AND solde >0";
		        break;
		    case 2:
		        $adh_solde_rq = " AND solde <0";
		        break;
		    case 3:
		        $adh_solde_rq = " AND solde =0";
		        break;
		}
		$connection = $this->getEntityManager()->getConnection();
	    $q = 'SELECT * FROM situation_appt 
	    		WHERE type_immeuble LIKE "%'.$type_immeuble.'%"
	    		 AND immeuble LIKE "%'.$immeuble.'%"
	    		 AND etage LIKE "%'.$etage.'%"
	    		 AND type_appartement LIKE "%'.$type_appartement.'%"
	    		 AND imm_group LIKE "%'.$imm_group.'%"
	    		 AND dossier LIKE "%'.$dossier.'%"
	    		';	
	    if($matricule!=null) $q .= ' AND matricule = "'.$matricule.'" ';
	    if($appartement!=null) $q .= ' AND appartement = "'.$appartement.'" ';
	    if($surface_appt!=null) $q .= ' AND surface_appt = "'.$surface_appt.'" ';
	    if($adh_solde!=null) $q .= $adh_solde_rq.' ';	
	    if($versement!=null) $q .= ' AND (versement+COALESCE(invalid, 0)) < '.$versement.' ';
	    if($pourcentage!=null) $q .= $pourcentage_rq.' ';	
	    $q .= 'ORDER BY matricule';
	    return $connection->executeQuery($q);
	}
	/*public function findDetailAdhesionAll(){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a detail,
							SUM(e.montant) totalversement, 
							((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) cout_global,
							100*SUM(e.montant)/((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) avancement')
		   ->add('from', 'AmbAdherentBundle:Adhesion a')
	  	   ->leftJoin('a.encaissements', 'e', 'WITH', 'e.type_encaissment = :versement AND e.statut = :statut AND e.adherent = a.adherent')
	  	   ->addSelect('e')
	  	   ->leftJoin('a.adherent', 'd')
	  	   ->addSelect('d')
	  	   ->Where('a.adherent <> :null');
	    // On peut rajouter ce qu'on veut avant
	    $qb->setParameters(array('versement' => 'VERSEMENT', 'statut' => 'valid',  'null' => ''));
	    // On peut rajouter ce qu'on veut après
	    $qb->groupBy('a.id');
	    return $qb;			
	}*/
	
	public function findDetailAdhesionDossierIncomplet(){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a detail,
							SUM(e.montant) totalversement, 
							((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) cout_global,
							100*SUM(e.montant)/((a.cout*a.surface_appt)+((a.cout/2)*(a.surface_terrace+a.surface_jardin))) avancement')
		   ->add('from', 'AmbAdherentBundle:Adhesion a')
	  	   ->leftJoin('a.encaissements', 'e', 'WITH', 'e.type_encaissment = :versement AND e.statut = :statut')
	  	   ->addSelect('e')
	  	   ->leftJoin('a.adherent', 'd')
	  	   ->addSelect('d')
	  	   ->Where('a.adherent <> :null AND a.dossier = :dossier');
	    // On peut rajouter ce qu'on veut avant
	    $qb->setParameters(array('versement' => 'VERSEMENT', 'statut' => 'valid',  'null' => '', 'dossier' => 'incomplet'));
	    // On peut rajouter ce qu'on veut après
	    $qb->groupBy('a.id');
	    
	    return $qb->getQuery()
	              ->getResult();				
	}
	
	public function ReturnEcheance($cout, $surf_appt, $surf_terrace, $surf_jardin, $type_echeance, $nb_mois, $avance){
		
		$cout_global = ($surf_appt * $cout) + (($surf_terrace + $surf_jardin)* ($cout/2));
		return ((($cout_global - $avance)/$nb_mois) * $type_echeance);			
	}

	public function findListReservation(){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a')
		   ->add('from', 'AmbAdherentBundle:Adhesion a');
	    // On peut rajouter ce qu'on veut avant
	    $qb->where('a.date_debutresrvation is not null AND a.date_finresrvation is not null ');
	         //->setParameters(array('versement' => 'VERSEMENT'));
	    
	    return $qb;
	    /*return $qb->getQuery()
	              ->getResult();	*/			
	}

	public function CountReservation(){
		$date_fin = new \Datetime(date('d-m-Y'));
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a')
		   ->add('from', 'AmbAdherentBundle:Adhesion a');
	    // On peut rajouter ce qu'on veut avant
	    $qb->where('a.date_debutresrvation is not null AND a.date_finresrvation is not null AND a.date_finresrvation <= :datefin')
	         ->setParameters(array('datefin' => $date_fin));
	    
	    return $qb->getQuery()
	              ->getResult();		
	}
}
