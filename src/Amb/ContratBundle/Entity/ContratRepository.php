<?php

namespace Amb\ContratBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ContratRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContratRepository extends EntityRepository
{
	public function findcontratactif(){
		$qb = $this->createQueryBuilder('c');
		$qb->add('select', 'c detail, SUM(d.montant) reglement')
		   ->add('from', 'AmbContratBundle:Contrat c')
	  	   ->leftJoin('c.depenses', 'd')
	  	   ->Where('c.date_resiliation is NULL');
	    $qb->groupBy('c.id');
	    return $qb->getQuery()
	              ->getResult();				
	}

	public function findcontratresilier(){
		$qb = $this->createQueryBuilder('c');
		$qb->add('select', 'c detail, SUM(d.montant) reglement')
		   ->add('from', 'AmbContratBundle:Contrat c')
	  	   ->leftJoin('c.depenses', 'd');
	    $qb->where(' c.date_resiliation <> :null')
	       ->setParameters(array('null' => ''))
	       ->groupBy('c.id');
	    
	    return $qb->getQuery()
	              ->getResult();				
	}
	//total des reglements de tous les conventions/contrats
	public function SumReglementConventions(){
		$qb = $this->createQueryBuilder('c');
		$qb->add('select', 'SUM(d.montant) reglement')
		   ->add('from', 'AmbContratBundle:Contrat c')
	  	   ->leftJoin('c.depenses', 'd')
	  	   ->Where('c.date_resiliation is NULL');
	    return $qb->getQuery()
	              ->getSingleScalarResult();				
	}
	//total des montants de tous les conventions/contrats
	public function SumMontantConventions(){
		$qb = $this->createQueryBuilder('c');
		$qb->add('select', 'SUM(c.montant)')
		   ->add('from', 'AmbContratBundle:Contrat c')
	  	   ->Where('c.date_resiliation is NULL');
	    return $qb->getQuery()
	              ->getSingleScalarResult();				
	}

	public function contratbyfrs_array($id){
		$qb = $this->createQueryBuilder('a');
		$qb->add('select', 'a');
	    // On peut rajouter ce qu'on veut avant
	    $qb->where(' a.date_resiliation is NULL AND a.fournisseur = :id')
	         ->setParameters(array('id' => $id));
	    
	    return $qb->getQuery()
	              ->getArrayResult();				
	}
}