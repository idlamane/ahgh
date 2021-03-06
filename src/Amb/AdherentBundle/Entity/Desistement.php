<?php

namespace Amb\AdherentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\AdherentBundle\Entity\Desistement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\AdherentBundle\Entity\DesistementRepository")
 */
class Desistement
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
     * @var \DateTime $date_desistement
     *
     * @ORM\Column(name="date_desistement", type="date")
     */
    private $date_desistement;

    /**
     * @var integer $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     * 
     */
    private $libelle;

    /**
     * @var integer $remboursement
     *
     * @ORM\Column(name="remboursement", type="string", length=255, nullable=true)
     * 
     */
    private $remboursement;


    /**
     * @var integer $matricule
     *
     * @ORM\Column(name="matricule", type="integer", nullable=true)
     * 
     */
    private $matricule;

    /**
     * @var integer $imm_group
     *
     * @ORM\Column(name="imm_group", type="string", length=255, nullable=true)
     * 
     */
    private $imm_group;

    /**
     * @var integer $type_immeuble
     *
     * @ORM\Column(name="type_immeuble", type="string", length=255, nullable=true)
     * 
     */
    private $type_immeuble;

    /**
     * @var integer $immeuble
     *
     * @ORM\Column(name="immeuble", type="string", length=255, nullable=true)
     * 
     */
    private $immeuble;
    /**
     * @var integer $etage
     *
     * @ORM\Column(name="etage", type="string", length=255, nullable=true)
     * 
     */
    private $etage;
    /**
     * @var integer $appartement
     *
     * @ORM\Column(name="appartement", type="string", length=255, nullable=true)
     * 
     */
    private $appartement;
    /**
     * @var integer $type_appartement
     *
     * @ORM\Column(name="type_appartement", type="string", length=255, nullable=true)
     * 
     */
    private $type_appartement;

    /**
     * @var integer $surface_appt
     *
     * @ORM\Column(name="surface_appt", type="integer", nullable=true)
     * 
     */
    private $surface_appt;

    /**
     * @var integer $surface_terrace
     *
     * @ORM\Column(name="surface_terrace", type="integer", nullable=true)
     * 
     */
    private $surface_terrace;

    /**
     * @var integer $surface_jardin
     *
     * @ORM\Column(name="surface_jardin", type="integer", nullable=true)
     * 
     */
    private $surface_jardin;

    /**
     * @var integer $cout
     *
     * @ORM\Column(name="cout", type="float", nullable=true)
     * 
     */
    private $cout;
    
    /**
     * @var \DateTime $date_adhesion
     *
     * @ORM\Column(name="date_adhesion", type="date", nullable=true)
     * 
     */
    private $date_adhesion;


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
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adherent", inversedBy="desistements")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adhesion", inversedBy="desistements")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $adhesion;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="desistement")
     */
    private $depenses;
    
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
     * Set date_desistement
     *
     * @param \DateTime $dateDesistement
     * @return Desistement
     */
    public function setDateDesistement($dateDesistement)
    {
        $this->date_desistement = $dateDesistement;
    
        return $this;
    }

    /**
     * Get date_desistement
     *
     * @return \DateTime 
     */
    public function getDateDesistement()
    {
        return $this->date_desistement;
    }

    /**
     * Set remboursement
     *
     * @param string $remboursement
     * @return Desistement
     */
    public function setRemboursement($remboursement)
    {
        $this->remboursement = $remboursement;
    
        return $this;
    }

    /**
     * Get remboursement
     *
     * @return string 
     */
    public function getRemboursement()
    {
        return $this->remboursement;
    }

    /**
     * Set adherent
     *
     * @param \Amb\AdherentBundle\Entity\Adherent $adherent
     * @return Desistement
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
     * Constructor
     */
    public function __construct()
    {
        $this->depenses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add depenses
     *
     * @param \Amb\DebitBundle\Entity\Depense $depenses
     * @return Desistement
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
        $depenses->setDesistement($this);
    
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Desistement
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
     * @return Desistement
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
     * Set matricule
     *
     * @param integer $matricule
     * @return Desistement
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
     * Set imm_group
     *
     * @param string $immGroup
     * @return Desistement
     */
    public function setImmGroup($immGroup)
    {
        $this->imm_group = $immGroup;
    
        return $this;
    }

    /**
     * Get imm_group
     *
     * @return string 
     */
    public function getImmGroup()
    {
        return $this->imm_group;
    }

    /**
     * Set type_immeuble
     *
     * @param string $typeImmeuble
     * @return Desistement
     */
    public function setTypeImmeuble($typeImmeuble)
    {
        $this->type_immeuble = $typeImmeuble;
    
        return $this;
    }

    /**
     * Get type_immeuble
     *
     * @return string 
     */
    public function getTypeImmeuble()
    {
        return $this->type_immeuble;
    }

    /**
     * Set immeuble
     *
     * @param string $immeuble
     * @return Desistement
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
     * @return Desistement
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
     * Set appartement
     *
     * @param string $appartement
     * @return Desistement
     */
    public function setAppartement($appartement)
    {
        $this->appartement = $appartement;
    
        return $this;
    }

    /**
     * Get appartement
     *
     * @return string 
     */
    public function getAppartement()
    {
        return $this->appartement;
    }

    /**
     * Set type_appartement
     *
     * @param string $typeAppartement
     * @return Desistement
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
     * Set surface_appt
     *
     * @param integer $surfaceAppt
     * @return Desistement
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
     * @return Desistement
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
     * @return Desistement
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
     * @return Desistement
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
     * Set date_adhesion
     *
     * @param \DateTime $dateAdhesion
     * @return Desistement
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
     * Set type_echeance
     *
     * @param integer $typeEcheance
     * @return Desistement
     */
    public function setTypeEcheance($typeEcheance)
    {
        $this->type_echeance = $typeEcheance;
    
        return $this;
    }

    /**
     * Get type_echeance
     *
     * @return integer 
     */
    public function getTypeEcheance()
    {
        return $this->type_echeance;
    }

    /**
     * Set nb_mois
     *
     * @param integer $nbMois
     * @return Desistement
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
     * @return Desistement
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
     * @return Desistement
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
     * Set avance
     *
     * @param float $avance
     * @return Desistement
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
     * Set libelle
     *
     * @param string $libelle
     * @return Desistement
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
     * Set adhesion
     *
     * @param \Amb\AdherentBundle\Entity\Adhesion $adhesion
     * @return Desistement
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
}