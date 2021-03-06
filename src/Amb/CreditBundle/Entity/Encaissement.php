<?php

namespace Amb\CreditBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\CreditBundle\Entity\Encaissement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\CreditBundle\Entity\EncaissementRepository")
 */
class Encaissement
{
	/**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $mode_encaissement
     *
     * @ORM\Column(name="mode_encaissement", type="string", length=255, nullable=true)
     * 
     */
    private $mode_encaissement;

    /**
     * @var integer $type_encaissment
     *
     * @ORM\Column(name="type_encaissment", type="string", length=255, nullable=true)
     * 
     */
    private $type_encaissment;

    /**
     * @var integer $banque_piece
     *
     * @ORM\Column(name="banque_piece", type="string", length=255, nullable=true)
     */
    private $banque_piece;

    /**
     * @var integer $num_piece
     *
     * @ORM\Column(name="num_piece", type="string", length=255, nullable=true)
     */
    private $num_piece;

    /**
     * @var integer $montant
     *
     * @ORM\Column(name="montant", type="float")
     * @Assert\NotBlank()
     */
    private $montant;
    
    /**
     * @var \DateTime $date_Operation
     *
     * @ORM\Column(name="date_Operation", type="date")
     * @Assert\NotBlank()
     */
    private $date_Operation;

    /**
     * @var integer $statut
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @var integer $annee_gestion
     *
     * @ORM\Column(name="annee_gestion", type="string", length=255, nullable=true)
     */
    private $annee_gestion;


    /**
     * @var integer $matricule
     *
     * @ORM\Column(name="matricule", type="integer", nullable=true)
     */
    private $matricule;


    /**
     * @var integer $source
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;


    /**
     * @var integer $compte
     *
     * @ORM\Column(name="compte", type="string", length=255, nullable=true)
     */
    private $compte;


    /**
     * @var integer $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adherent", inversedBy="encaissements")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adhesion", inversedBy="encaissements")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adhesion;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\ParamBundle\Entity\Banque", inversedBy="encaissements")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $banque;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\CreditBundle\Entity\Quitance", inversedBy="encaissement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $quitance;

    /**
     * @var \DateTime $created_at
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $created_at;
    
    /**
     * @var \DateTime $updated_at
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mode_encaissement
     *
     * @param string $modeEncaissement
     * @return Encaissement
     */
    public function setModeEncaissement($modeEncaissement)
    {
        $this->mode_encaissement = $modeEncaissement;
    
        return $this;
    }

    /**
     * Get mode_encaissement
     *
     * @return string 
     */
    public function getModeEncaissement()
    {
        return $this->mode_encaissement;
    }

    /**
     * Set type_encaissment
     *
     * @param string $typeEncaissment
     * @return Encaissement
     */
    public function setTypeEncaissment($typeEncaissment)
    {
        $this->type_encaissment = $typeEncaissment;
    
        return $this;
    }

    /**
     * Get type_encaissment
     *
     * @return string 
     */
    public function getTypeEncaissment()
    {
        return $this->type_encaissment;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Encaissement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    
        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set date_Operation
     *
     * @param \DateTime $dateOperation
     * @return Encaissement
     */
    public function setDateOperation($dateOperation)
    {
        $this->date_Operation = $dateOperation;
    
        return $this;
    }

    /**
     * Get date_Operation
     *
     * @return \DateTime 
     */
    public function getDateOperation()
    {
        return $this->date_Operation;
    }

    /**
     * Set adherent
     *
     * @param \Amb\AdherentBundle\Entity\Adherent $adherent
     * @return Encaissement
     */
    public function setAdherent(\Amb\AdherentBundle\Entity\Adherent $adherent = null)
    {
        $this->adherent = $adherent;
    
        return $this;
    }

    /**
     * Get adherent
     *
     * @return \Amb\AdherentBundle\Entity\Adherent 
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set adhesion
     *
     * @param \Amb\AdherentBundle\Entity\Adhesion $adhesion
     * @return Encaissement
     */
    public function setAdhesion(\Amb\AdherentBundle\Entity\Adhesion $adhesion = null)
    {
        $this->adhesion = $adhesion;
    
        return $this;
    }

    /**
     * Get adhesion
     *
     * @return \Amb\AdherentBundle\Entity\Adhesion 
     */
    public function getAdhesion()
    {
        return $this->adhesion;
    }

    /**
     * Set num_piece
     *
     * @param string $numPiece
     * @return Encaissement
     */
    public function setNumPiece($numPiece)
    {
        $this->num_piece = $numPiece;
    
        return $this;
    }

    /**
     * Get num_piece
     *
     * @return string 
     */
    public function getNumPiece()
    {
        return $this->num_piece;
    }

    /**
     * Set banque
     *
     * @param \Amb\ParamBundle\Entity\Banque $banque
     * @return Encaissement
     */
    public function setBanque(\Amb\ParamBundle\Entity\Banque $banque = null)
    {
        $this->banque = $banque;
    
        return $this;
    }

    /**
     * Get banque
     *
     * @return \Amb\ParamBundle\Entity\Banque 
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return Encaissement
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Encaissement
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Encaissement
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set quitance
     *
     * @param \Amb\CreditBundle\Entity\Quitance $quitance
     * @return Encaissement
     */
    public function setQuitance(\Amb\CreditBundle\Entity\Quitance $quitance = null)
    {
        $this->quitance = $quitance;
        return $this;
    }

    /**
     * Get quitance
     *
     * @return \Amb\CreditBundle\Entity\Quitance 
     */
    public function getQuitance()
    {
        return $this->quitance;
    }

    /**
     * Set banque_piece
     *
     * @param string $banquePiece
     * @return Encaissement
     */
    public function setBanquePiece($banquePiece)
    {
        $this->banque_piece = $banquePiece;
    
        return $this;
    }

    /**
     * Get banque_piece
     *
     * @return string 
     */
    public function getBanquePiece()
    {
        return $this->banque_piece;
    }

    /**
     * Set annee_gestion
     *
     * @param string $anneeGestion
     * @return Encaissement
     */
    public function setAnneeGestion($anneeGestion)
    {
        $this->annee_gestion = $anneeGestion;
    
        return $this;
    }

    /**
     * Get annee_gestion
     *
     * @return string 
     */
    public function getAnneeGestion()
    {
        return $this->annee_gestion;
    }

    /**
     * Set matricule
     *
     * @param integer $matricule
     * @return Encaissement
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    
        return $this;
    }

    /**
     * Get matricule
     *
     * @return integer 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Encaissement
     */
    public function setSource($source)
    {
        $this->source = $source;
    
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set compte
     *
     * @param string $compte
     * @return Encaissement
     */
    public function setCompte($compte)
    {
        $this->compte = $compte;
    
        return $this;
    }

    /**
     * Get compte
     *
     * @return string 
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Encaissement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}