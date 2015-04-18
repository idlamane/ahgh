<?php

namespace Amb\AdherentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\AdherentBundle\Entity\Adhesion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\AdherentBundle\Entity\AdhesionRepository")
 */
class Adhesion
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
     * @var integer $matricule
     *
     * @ORM\Column(name="matricule", type="integer")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $matricule;

    /**
     * @var integer $imm_group
     *
     * @ORM\Column(name="imm_group", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $imm_group;

    /**
     * @var integer $type_immeuble
     *
     * @ORM\Column(name="type_immeuble", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $type_immeuble;

    /**
     * @var integer $dossier
     *
     * @ORM\Column(name="dossier", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $dossier;

    /**
     * @var integer $immeuble
     *
     * @ORM\Column(name="immeuble", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $immeuble;
    /**
     * @var integer $etage
     *
     * @ORM\Column(name="etage", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $etage;
    /**
     * @var integer $appartement
     *
     * @ORM\Column(name="appartement", type="integer")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $appartement;
    /**
     * @var integer $type_appartement
     *
     * @ORM\Column(name="type_appartement", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $type_appartement;

    /**
     * @var integer $surface_appt
     *
     * @ORM\Column(name="surface_appt", type="integer")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $surface_appt;

    /**
     * @var integer $surface_terrace
     *
     * @ORM\Column(name="surface_terrace", type="integer", nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $surface_terrace;

    /**
     * @var integer $surface_jardin
     *
     * @ORM\Column(name="surface_jardin", type="integer", nullable=true)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $surface_jardin;

    /**
     * @var integer $cout
     *
     * @ORM\Column(name="cout", type="float")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $cout;
    
    /**
     * @var \DateTime $date_adhesion
     *
     * @ORM\Column(name="date_adhesion", type="date")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $date_adhesion;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adherent", inversedBy="adhesions")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adherent;


    /**
     * @var integer $type_echeance
     *
     * @ORM\Column(name="type_echeance", type="integer", nullable=true)
     */
    private $type_echeance;

    /**
     * @var integer $nb_mois
     *
     * @ORM\Column(name="nb_mois", type="integer", nullable=true)
     */
    private $nb_mois;

    /**
     * @var \DateTime $date_debut
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $date_debut;

    /**
     * @var integer $echeance
     *
     * @ORM\Column(name="echeance", type="float", nullable=true)
     */
    private $echeance;

    /**
     * @var integer $avance
     *
     * @ORM\Column(name="avance", type="float", nullable=true)
     */
    private $avance;

    /**
     * @var string $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
    /**
     * @var \DateTime $date_debutresrvation
     *
     * @ORM\Column(name="date_debutresrvation", type="date", nullable=true)
     */
    private $date_debutresrvation;
    
    /**
     * @var \DateTime $date_finresrvation
     *
     * @ORM\Column(name="date_finresrvation", type="date", nullable=true)
     */
    private $date_finresrvation;

    /**
     * @var integer $piece_garantie
     *
     * @ORM\Column(name="piece_reservation", type="string", length=255, nullable=true)
     */
    private $piece_reservation;

    /**
     * @var integer $montant_garantie
     *
     * @ORM\Column(name="montant_garantie", type="float", nullable=true)
     */
    private $montant_garantie;

    
    /**
     * @ORM\OneToMany(targetEntity="Amb\CreditBundle\Entity\Encaissement", mappedBy="adhesion")
     */
    private $encaissements;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\AdherentBundle\Entity\Desistement", mappedBy="adhesion")
     */
    private $desistements;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="adhesion")
     */
    private $depenses;

    
    /**
     * @ORM\OneToMany(targetEntity="Amb\GlobalBundle\Entity\Scann", mappedBy="adhesion")
     */
    private $scanns;
    
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
     * Set appartement
     *
     * @param integer $appartement
     * @return Adhesion
     */
    public function setAppartement($appartement)
    {
        $this->appartement = $appartement;
    
        return $this;
    }

    /**
     * Get appartement
     *
     * @return integer 
     */
    public function getAppartement()
    {
        return $this->appartement;
    }

    /**
     * Set surface_appt
     *
     * @param integer $surfaceAppt
     * @return Adhesion
     */
    public function setSurfaceAppt($surfaceAppt)
    {
        $this->surface_appt = $surfaceAppt;
    
        return $this;
    }

    /**
     * Get surface_appt
     *
     * @return integer 
     */
    public function getSurfaceAppt()
    {
        return $this->surface_appt;
    }

    /**
     * Set surface_terrace
     *
     * @param integer $surfaceTerrace
     * @return Adhesion
     */
    public function setSurfaceTerrace($surfaceTerrace)
    {
        $this->surface_terrace = $surfaceTerrace;
    
        return $this;
    }

    /**
     * Get surface_terrace
     *
     * @return integer 
     */
    public function getSurfaceTerrace()
    {
        return $this->surface_terrace;
    }

    /**
     * Set surface_jardin
     *
     * @param integer $surfaceJardin
     * @return Adhesion
     */
    public function setSurfaceJardin($surfaceJardin)
    {
        $this->surface_jardin = $surfaceJardin;
    
        return $this;
    }

    /**
     * Get surface_jardin
     *
     * @return integer 
     */
    public function getSurfaceJardin()
    {
        return $this->surface_jardin;
    }

    /**
     * Set cout
     *
     * @param float $cout
     * @return Adhesion
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    
        return $this;
    }

    /**
     * Get cout
     *
     * @return float 
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * Set adherent
     *
     * @param \Amb\AdherentBundle\Entity\Adherent $adherent
     * @return Adhesion
     */
    public function setAdherent(\Amb\AdherentBundle\Entity\Adherent $adherent=null)
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
     * Set immeuble
     *
     * @param string $immeuble
     * @return Adhesion
     */
    public function setImmeuble($immeuble)
    {
        $this->immeuble = $immeuble;
    
        return $this;
    }

    /**
     * Get immeuble
     *
     * @return string 
     */
    public function getImmeuble()
    {
        return $this->immeuble;
    }

    /**
     * Set etage
     *
     * @param string $etage
     * @return Adhesion
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;
    
        return $this;
    }

    /**
     * Get etage
     *
     * @return string 
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set type_appartement
     *
     * @param string $typeAppartement
     * @return Adhesion
     */
    public function setTypeAppartement($typeAppartement)
    {
        $this->type_appartement = $typeAppartement;
    
        return $this;
    }

    /**
     * Get type_appartement
     *
     * @return string 
     */
    public function getTypeAppartement()
    {
        return $this->type_appartement;
    }

    /**
     * Set date_adhesion
     *
     * @param \DateTime $dateAdhesion
     * @return Adhesion
     */
    public function setDateAdhesion($dateAdhesion)
    {
        $this->date_adhesion = $dateAdhesion;
    
        return $this;
    }

    /**
     * Get date_adhesion
     *
     * @return \DateTime 
     */
    public function getDateAdhesion()
    {
        return $this->date_adhesion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->encaissements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add encaissements
     *
     * @param \Amb\CreditBundle\Entity\Encaissement $encaissements
     * @return Adhesion
     */
    public function addEncaissement(\Amb\CreditBundle\Entity\Encaissement $encaissements)
    {
        $this->encaissements[] = $encaissements;
    	$encaissements->setAdhesion($this);
        return $this;
    }

    /**
     * Remove encaissements
     *
     * @param \Amb\CreditBundle\Entity\Encaissement $encaissements
     */
    public function removeEncaissement(\Amb\CreditBundle\Entity\Encaissement $encaissements)
    {
        $this->encaissements->removeElement($encaissements);
    }

    /**
     * Get encaissements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEncaissements()
    {
        return $this->encaissements;
    }

    /**
     * Set imm_group
     *
     * @param integer $immGroup
     * @return Adhesion
     */
    public function setImmGroup($immGroup)
    {
        $this->imm_group = $immGroup;
    
        return $this;
    }

    /**
     * Get imm_group
     *
     * @return integer 
     */
    public function getImmGroup()
    {
        return $this->imm_group;
    }

    /**
     * Set type_immeuble
     *
     * @param integer $typeImmeuble
     * @return Adhesion
     */
    public function setTypeImmeuble($typeImmeuble)
    {
        $this->type_immeuble = $typeImmeuble;
    
        return $this;
    }

    /**
     * Get type_immeuble
     *
     * @return integer 
     */
    public function getTypeImmeuble()
    {
        return $this->type_immeuble;
    }

    /**
     * Set type_echeance
     *
     * @param string $typeEcheance
     * @return Adhesion
     */
    public function setTypeEcheance($typeEcheance)
    {
        $this->type_echeance = $typeEcheance;
    
        return $this;
    }

    /**
     * Get type_echeance
     *
     * @return string 
     */
    public function getTypeEcheance()
    {
        return $this->type_echeance;
    }

    /**
     * Set nb_mois
     *
     * @param integer $nbMois
     * @return Adhesion
     */
    public function setNbMois($nbMois)
    {
        $this->nb_mois = $nbMois;
    
        return $this;
    }

    /**
     * Get nb_mois
     *
     * @return integer 
     */
    public function getNbMois()
    {
        return $this->nb_mois;
    }

    /**
     * Set date_debut
     *
     * @param \DateTime $dateDebut
     * @return Adhesion
     */
    public function setDateDebut($dateDebut)
    {
        $this->date_debut = $dateDebut;
    
        return $this;
    }

    /**
     * Get date_debut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * Set echeance
     *
     * @param float $echeance
     * @return Adhesion
     */
    public function setEcheance($echeance)
    {
        $this->echeance = $echeance;
    
        return $this;
    }

    /**
     * Get echeance
     *
     * @return float 
     */
    public function getEcheance()
    {
        return $this->echeance;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Adhesion
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
     * Set avance
     *
     * @param float $avance
     * @return Adhesion
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;
    
        return $this;
    }

    /**
     * Get avance
     *
     * @return float 
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * Add desistements
     *
     * @param \Amb\AdherentBundle\Entity\Desistement $desistements
     * @return Adhesion
     */
    public function addDesistement(\Amb\AdherentBundle\Entity\Desistement $desistements)
    {
        $this->desistements[] = $desistements;
        $desistements->setAdhesion($this);
    
        return $this;
    }

    /**
     * Remove desistements
     *
     * @param \Amb\AdherentBundle\Entity\Desistement $desistements
     */
    public function removeDesistement(\Amb\AdherentBundle\Entity\Desistement $desistements)
    {
        $this->desistements->removeElement($desistements);
    }

    /**
     * Get desistements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDesistements()
    {
        return $this->desistements;
    }

    /**
     * Set matricule
     *
     * @param integer $matricule
     * @return Adhesion
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Adhesion
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
     * @return Adhesion
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
     * Set dossier
     *
     * @param string $dossier
     * @return Adhesion
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;
    
        return $this;
    }

    /**
     * Get dossier
     *
     * @return string 
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Add depenses
     *
     * @param \Amb\DebitBundle\Entity\Depense $depenses
     * @return Adhesion
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
        $depenses->setAdhesion($this);
    
        return $this;
    }

    /**
     * Remove depenses
     *
     * @param \Amb\DebitBundle\Entity\Depense $depenses
     */
    public function removeDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses->removeElement($depenses);
    }

    /**
     * Get depenses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepenses()
    {
        return $this->depenses;
    }

    /**
     * Add scanns
     *
     * @param \Amb\GlobalBundle\Entity\Scanns $scanns
     * @return Adhesion
     */
    public function addScann(\Amb\GlobalBundle\Entity\Scann $scanns)
    {
        $this->scanns[] = $scanns;
        $scanns->setAdhesion($this);
    
        return $this;
    }

    /**
     * Remove scanns
     *
     * @param \Amb\GlobalBundle\Entity\Scanns $scanns
     */
    public function removeScann(\Amb\GlobalBundle\Entity\Scann $scanns)
    {
        $this->scanns->removeElement($scanns);
    }

    /**
     * Get scanns
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScanns()
    {
        return $this->scanns;
    }

    /**
     * Set date_debutresrvation
     *
     * @param \DateTime $dateDebutresrvation
     * @return Adhesion
     */
    public function setDateDebutresrvation($dateDebutresrvation)
    {
        $this->date_debutresrvation = $dateDebutresrvation;
    
        return $this;
    }

    /**
     * Get date_debutresrvation
     *
     * @return \DateTime 
     */
    public function getDateDebutresrvation()
    {
        return $this->date_debutresrvation;
    }

    /**
     * Set date_finresrvation
     *
     * @param \DateTime $dateFinresrvation
     * @return Adhesion
     */
    public function setDateFinresrvation($dateFinresrvation)
    {
        $this->date_finresrvation = $dateFinresrvation;
    
        return $this;
    }

    /**
     * Get date_finresrvation
     *
     * @return \DateTime 
     */
    public function getDateFinresrvation()
    {
        return $this->date_finresrvation;
    }

    /**
     * Set piece_reservation
     *
     * @param string $pieceReservation
     * @return Adhesion
     */
    public function setPieceReservation($pieceReservation)
    {
        $this->piece_reservation = $pieceReservation;
    
        return $this;
    }

    /**
     * Get piece_reservation
     *
     * @return string 
     */
    public function getPieceReservation()
    {
        return $this->piece_reservation;
    }

    /**
     * Set montant_garantie
     *
     * @param float $montantGarantie
     * @return Adhesion
     */
    public function setMontantGarantie($montantGarantie)
    {
        $this->montant_garantie = $montantGarantie;
    
        return $this;
    }

    /**
     * Get montant_garantie
     *
     * @return float 
     */
    public function getMontantGarantie()
    {
        return $this->montant_garantie;
    }
}