<?php

namespace Amb\DebitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\DebitBundle\Entity\Depense
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\DebitBundle\Entity\DepenseRepository")
 */
class Depense
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
     * @var integer $mode_retrait
     *
     * @ORM\Column(name="mode_retrait", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mode_retrait;

    /**
     * @var integer $n_piece
     *
     * @ORM\Column(name="n_piece", type="string", length=255, nullable=true)
     * 
     */
    private $n_piece;

    /**
     * @var integer $facture
     *
     * @ORM\Column(name="facture", type="string", length=255, nullable=true)
     * 
     */
    private $facture;

    /**
     * @var integer $date_operation
     *
     * @ORM\Column(name="date_operation", type="date")
     * @Assert\NotBlank()
     */
    private $date_operation;

    /**
     * @var integer $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     * 
     */
    private $libelle;

    /**
     * @var integer $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     * 
     */
    private $commentaire;

    /**
     * @var integer $montant
     *
     * @ORM\Column(name="montant", type="float")
     * @Assert\NotBlank()
     */
    private $montant;
    
    /**
     * @var \Boolean $caisse
     *
     * @ORM\Column(name="caisse", type="boolean", nullable=true)
     */
    private $caisse;

    /**
     * @var integer $type_remboursement
     *
     * @ORM\Column(name="type_remboursement", type="string", length=255, nullable=true)
     */
    private $type_remboursement;

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
     * @ORM\ManyToOne(targetEntity="Amb\ParamBundle\Entity\Banque", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $banque;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\DebitBundle\Entity\Fournisseur", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\DebitBundle\Entity\TypeDepense", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $typedepense;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Desistement", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $desistement;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\ContratBundle\Entity\Contrat", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $contrat;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adherent", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adhesion", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adhesion;

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
     * Set mode_retrait
     *
     * @param string $modeRetrait
     * @return Depense
     */
    public function setModeRetrait($modeRetrait)
    {
        $this->mode_retrait = $modeRetrait;
    
        return $this;
    }

    /**
     * Get mode_retrait
     *
     * @return string 
     */
    public function getModeRetrait()
    {
        return $this->mode_retrait;
    }

    /**
     * Set n_piece
     *
     * @param string $nPiece
     * @return Depense
     */
    public function setNPiece($nPiece)
    {
        $this->n_piece = $nPiece;
    
        return $this;
    }

    /**
     * Get n_piece
     *
     * @return string 
     */
    public function getNPiece()
    {
        return $this->n_piece;
    }

    /**
     * Set date_operation
     *
     * @param \DateTime $dateOperation
     * @return Depense
     */
    public function setDateOperation($dateOperation)
    {
        $this->date_operation = $dateOperation;
    
        return $this;
    }

    /**
     * Get date_operation
     *
     * @return \DateTime 
     */
    public function getDateOperation()
    {
        return $this->date_operation;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Depense
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

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Depense
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    
        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Depense
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
     * Set banque
     *
     * @param \Amb\ParamBundle\Entity\Banque $banque
     * @return Depense
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
     * Set typedepense
     *
     * @param \Amb\DebitBundle\Entity\TypeDepense $typedepense
     * @return Depense
     */
    public function setTypedepense(\Amb\DebitBundle\Entity\TypeDepense $typedepense = null)
    {
        $this->typedepense = $typedepense;
    
        return $this;
    }

    /**
     * Get typedepense
     *
     * @return \Amb\DebitBundle\Entity\TypeDepense 
     */
    public function getTypedepense()
    {
        return $this->typedepense;
    }

    /**
     * Set fournisseur
     *
     * @param \Amb\DebitBundle\Entity\Fournisseur $fournisseur
     * @return Depense
     */
    public function setFournisseur(\Amb\DebitBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;
    
        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \Amb\DebitBundle\Entity\Fournisseur 
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set desistement
     *
     * @param \Amb\AdherentBundle\Entity\Desistement $desistement
     * @return Depense
     */
    public function setDesistement(\Amb\AdherentBundle\Entity\Desistement $desistement = null)
    {
        $this->desistement = $desistement;
    
        return $this;
    }

    /**
     * Get desistement
     *
     * @return \Amb\AdherentBundle\Entity\Desistement 
     */
    public function getDesistement()
    {
        return $this->desistement;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Depense
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
     * @return Depense
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
     * Set contrat
     *
     * @param \Amb\ContratBundle\Entity\Contrat $contrat
     * @return Depense
     */
    public function setContrat(\Amb\ContratBundle\Entity\Contrat $contrat = null)
    {
        $this->contrat = $contrat;
    
        return $this;
    }

    /**
     * Get contrat
     *
     * @return \Amb\ContratBundle\Entity\Contrat 
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set caisse
     *
     * @param boolean $caisse
     * @return Depense
     */
    public function setCaisse($caisse)
    {
        $this->caisse = $caisse;
    
        return $this;
    }

    /**
     * Get caisse
     *
     * @return boolean 
     */
    public function getCaisse()
    {
        return $this->caisse;
    }

    /**
     * Set facture
     *
     * @param string $facture
     * @return Depense
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;
    
        return $this;
    }

    /**
     * Get facture
     *
     * @return string 
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * Set type_remboursement
     *
     * @param string $typeRemboursement
     * @return Depense
     */
    public function setTypeRemboursement($typeRemboursement)
    {
        $this->type_remboursement = $typeRemboursement;
    
        return $this;
    }

    /**
     * Get type_remboursement
     *
     * @return string 
     */
    public function getTypeRemboursement()
    {
        return $this->type_remboursement;
    }

    /**
     * Set annee_gestion
     *
     * @param string $anneeGestion
     * @return Depense
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
     * Set adherent
     *
     * @param \Amb\AdherentBundle\Entity\Adherent $adherent
     * @return Depense
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
     * @return Depense
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
     * Set matricule
     *
     * @param integer $matricule
     * @return Depense
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
}