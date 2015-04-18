<?php

namespace Amb\AdherentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\AdherentBundle\Entity\Adherent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\AdherentBundle\Entity\AdherentRepository")
 * @UniqueEntity(fields="email", message="Un adhérent existe déjà avec cet email.")
 */
class Adherent
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
     * @var integer $civilite
     *
     * @ORM\Column(name="civilite", type="string", length=255, nullable=true)
     * 
     */
    private $civilite;

    /**
     * @var string $nom_prenom
     *
     * @ORM\Column(name="nom_prenom", type="string", length=255)
     * @Assert\NotBlank(message="Le nom est un champ obligatoire.")
     */
    private $nom_prenom;

    /**
     * @var string $cin
     *
     * @ORM\Column(name="cin", type="string", length=100)
     * @Assert\NotBlank(message="La CIN est un champ obligatoire.")
     */
    private $cin;

    /**
     * @var \DateTime $date_n
     *
     * @ORM\Column(name="date_n", type="date", nullable=true)
     */
    private $date_n;

    /**
     * @var string $adress
     *
     * @ORM\Column(name="adress", type="text", nullable=true)
     */
    private $adress;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="tel", type="string", length=100, nullable=true)
     */
    private $tel;

    /**
     * @var string $tel2
     *
     * @ORM\Column(name="tel2", type="string", length=100, nullable=true)
     */
    private $tel2;

    /**
     * @var string $mobile
     *
     * @ORM\Column(name="mobile", type="string", length=100, nullable=true)
     */
    private $mobile;

    /**
     * @var string $mobile2
     *
     * @ORM\Column(name="mobile2", type="string", length=100, nullable=true)
     */
    private $mobile2;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=100, nullable=true)
     */
    private $fax;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var string $profession
     *
     * @ORM\Column(name="profession", type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @var string $banque
     *
     * @ORM\Column(name="banque", type="string", length=255, nullable=true)
     */
    private $banque;

    /**
     * @var string $n_compte_bq
     *
     * @ORM\Column(name="n_compte_bq", type="string", length=255, nullable=true)
     */
    private $n_compte_bq;

    /**
     * @var integer $attest_rib
     *
     * @ORM\Column(name="attest_rib", type="string", length=255, nullable=true)
     */
    private $attest_rib;

    /**
     * @var string $nom_pere
     *
     * @ORM\Column(name="nom_pere", type="string", length=255, nullable=true)
     */
    private $nom_pere;

    /**
     * @var string $nom_mere
     *
     * @ORM\Column(name="nom_mere", type="string", length=255, nullable=true)
     */
    private $nom_mere;

    /**
     * @var string $etat_civile
     *
     * @ORM\Column(name="etat_civile", type="string", length=255, nullable=true)
     */
    private $etat_civile;

    /**
     * @var string $nom_conjoint
     *
     * @ORM\Column(name="nom_conjoint", type="string", length=255, nullable=true)
     */
    private $nom_conjoint;

    /**
     * @var string $cin_conj
     *
     * @ORM\Column(name="cin_conj", type="string", length=100, nullable=true)
     */
    private $cin_conj;

    /**
     * @var \DateTime $date_n_conj
     *
     * @ORM\Column(name="date_n_conj", type="date", nullable=true)
     */
    private $date_n_conj;

    /**
     * @var \DateTime $date_mariage
     *
     * @ORM\Column(name="date_mariage", type="date", nullable=true)
     */
    private $date_mariage;

    /**
     * @var integer $nb_enfant
     *
     * @ORM\Column(name="nb_enfant", type="smallint", nullable=true)
     */
    private $nb_enfant;

    /**
     * @var string $prenom_enf
     *
     * @ORM\Column(name="prenom_enf", type="string", length=255, nullable=true)
     */
    private $prenom_enf;

    /**
     * @var string $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
    /**
     * @var \DateTime $date_inscription
     *
     * @ORM\Column(name="date_inscription", type="date", nullable=true)
     */
    private $date_inscription;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\AdherentBundle\Entity\Adhesion", mappedBy="adherent")
     */
    private $adhesions;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\CreditBundle\Entity\Encaissement", mappedBy="adherent")
     */
    private $encaissements;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\AdherentBundle\Entity\Desistement", mappedBy="adherent")
     */
    private $desistements;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="adherent")
     */
    private $depenses;

    
    /**
     * @ORM\OneToMany(targetEntity="Amb\GlobalBundle\Entity\Scann", mappedBy="adherent")
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
     * Set cin
     *
     * @param string $cin
     * @return Adherent
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    
        return $this;
    }

    /**
     * Get cin
     *
     * @return string 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set date_n
     *
     * @param \DateTime $dateN
     * @return Adherent
     */
    public function setDateN($dateN)
    {
        $this->date_n = $dateN;
    
        return $this;
    }

    /**
     * Get date_n
     *
     * @return \DateTime 
     */
    public function getDateN()
    {
        return $this->date_n;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Adherent
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
    
        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Adherent
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Adherent
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Adherent
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Adherent
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set profession
     *
     * @param string $profession
     * @return Adherent
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    
        return $this;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set banque
     *
     * @param string $banque
     * @return Adherent
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;
    
        return $this;
    }

    /**
     * Get banque
     *
     * @return string 
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set n_compte_bq
     *
     * @param string $nCompteBq
     * @return Adherent
     */
    public function setNCompteBq($nCompteBq)
    {
        $this->n_compte_bq = $nCompteBq;
    
        return $this;
    }

    /**
     * Get n_compte_bq
     *
     * @return string 
     */
    public function getNCompteBq()
    {
        return $this->n_compte_bq;
    }

    /**
     * Set attest_rib
     *
     * @param integer $attestRib
     * @return Adherent
     */
    public function setAttestRib($attestRib)
    {
        $this->attest_rib = $attestRib;
    
        return $this;
    }

    /**
     * Get attest_rib
     *
     * @return integer 
     */
    public function getAttestRib()
    {
        return $this->attest_rib;
    }

    /**
     * Set nom_pere
     *
     * @param string $nomPere
     * @return Adherent
     */
    public function setNomPere($nomPere)
    {
        $this->nom_pere = $nomPere;
    
        return $this;
    }

    /**
     * Get nom_pere
     *
     * @return string 
     */
    public function getNomPere()
    {
        return $this->nom_pere;
    }

    /**
     * Set nom_mere
     *
     * @param string $nomMere
     * @return Adherent
     */
    public function setNomMere($nomMere)
    {
        $this->nom_mere = $nomMere;
    
        return $this;
    }

    /**
     * Get nom_mere
     *
     * @return string 
     */
    public function getNomMere()
    {
        return $this->nom_mere;
    }

    /**
     * Set etat_civile
     *
     * @param string $etatCivile
     * @return Adherent
     */
    public function setEtatCivile($etatCivile)
    {
        $this->etat_civile = $etatCivile;
    
        return $this;
    }

    /**
     * Get etat_civile
     *
     * @return string 
     */
    public function getEtatCivile()
    {
        return $this->etat_civile;
    }

    /**
     * Set nom_conjoint
     *
     * @param string $nomConjoint
     * @return Adherent
     */
    public function setNomConjoint($nomConjoint)
    {
        $this->nom_conjoint = $nomConjoint;
    
        return $this;
    }

    /**
     * Get nom_conjoint
     *
     * @return string 
     */
    public function getNomConjoint()
    {
        return $this->nom_conjoint;
    }

    /**
     * Set cin_conj
     *
     * @param string $cinConj
     * @return Adherent
     */
    public function setCinConj($cinConj)
    {
        $this->cin_conj = $cinConj;
    
        return $this;
    }

    /**
     * Get cin_conj
     *
     * @return string 
     */
    public function getCinConj()
    {
        return $this->cin_conj;
    }

    /**
     * Set date_n_conj
     *
     * @param \DateTime $dateNConj
     * @return Adherent
     */
    public function setDateNConj($dateNConj)
    {
        $this->date_n_conj = $dateNConj;
    
        return $this;
    }

    /**
     * Get date_n_conj
     *
     * @return \DateTime 
     */
    public function getDateNConj()
    {
        return $this->date_n_conj;
    }

    /**
     * Set date_mariage
     *
     * @param \DateTime $dateMariage
     * @return Adherent
     */
    public function setDateMariage($dateMariage)
    {
        $this->date_mariage = $dateMariage;
    
        return $this;
    }

    /**
     * Get date_mariage
     *
     * @return \DateTime 
     */
    public function getDateMariage()
    {
        return $this->date_mariage;
    }

    /**
     * Set nb_enfant
     *
     * @param integer $nbEnfant
     * @return Adherent
     */
    public function setNbEnfant($nbEnfant)
    {
        $this->nb_enfant = $nbEnfant;
    
        return $this;
    }

    /**
     * Get nb_enfant
     *
     * @return integer 
     */
    public function getNbEnfant()
    {
        return $this->nb_enfant;
    }

    /**
     * Set prenom_enf
     *
     * @param string $prenomEnf
     * @return Adherent
     */
    public function setPrenomEnf($prenomEnf)
    {
        $this->prenom_enf = $prenomEnf;
    
        return $this;
    }

    /**
     * Get prenom_enf
     *
     * @return string 
     */
    public function getPrenomEnf()
    {
        return $this->prenom_enf;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Adherent
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
     * Set date_inscription
     *
     * @param \DateTime $dateInscription
     * @return Adherent
     */
    public function setDateInscription($dateInscription)
    {
        $this->date_inscription = $dateInscription;
    
        return $this;
    }

    /**
     * Get date_inscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->date_inscription;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->adhesions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encaissements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add adhesions
     *
     * @param \Amb\AdherentBundle\Entity\Adhesion $adhesions
     * @return Adherent
     */
    public function addAdhesion(\Amb\AdherentBundle\Entity\Adhesion $adhesions)
    {
        $this->adhesions[] = $adhesions;
        $adhesions->setAdherent($this);
        return $this;
    }

    /**
     * Remove adhesions
     *
     * @param \Amb\AdherentBundle\Entity\Adhesion $adhesions
     */
    public function removeAdhesion(\Amb\AdherentBundle\Entity\Adhesion $adhesions)
    {
        $this->adhesions->removeElement($adhesions);
    }

    /**
     * Get adhesions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdhesions()
    {
        return $this->adhesions;
    }

    /**
     * Add encaissements
     *
     * @param \Amb\CreditBundle\Entity\Encaissement $encaissements
     * @return Adherent
     */
    public function addEncaissement(\Amb\CreditBundle\Entity\Encaissement $encaissements)
    {
        $this->encaissements[] = $encaissements;
        $encaissements->setAdherent($this);
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
     * Set civilite
     *
     * @param integer $civilite
     * @return Adherent
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    
        return $this;
    }

    /**
     * Get civilite
     *
     * @return integer 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Add desistements
     *
     * @param \Amb\AdherentBundle\Entity\Desistement $desistements
     * @return Adherent
     */
    public function addDesistement(\Amb\AdherentBundle\Entity\Desistement $desistements)
    {
        $this->desistements[] = $desistements;
        $desistements->setAdherent($this);
    
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
     * Set nom_prenom
     *
     * @param string $nomPrenom
     * @return Adherent
     */
    public function setNomPrenom($nomPrenom)
    {
        $this->nom_prenom = $nomPrenom;
    
        return $this;
    }

    /**
     * Get nom_prenom
     *
     * @return string 
     */
    public function getNomPrenom()
    {
        return $this->nom_prenom;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Adherent
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
     * @return Adherent
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
     * Set tel2
     *
     * @param string $tel2
     * @return Adherent
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;
    
        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set mobile2
     *
     * @param string $mobile2
     * @return Adherent
     */
    public function setMobile2($mobile2)
    {
        $this->mobile2 = $mobile2;
    
        return $this;
    }

    /**
     * Get mobile2
     *
     * @return string 
     */
    public function getMobile2()
    {
        return $this->mobile2;
    }

    /**
     * Add depenses
     *
     * @param \Amb\DebitBundle\Entity\Depense $depenses
     * @return Adherent
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
        $depenses->setAdherent($this);
    
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
     * @param \Amb\GlobalBundle\Entity\Scann $scanns
     * @return Adherent
     */
    public function addScann(\Amb\GlobalBundle\Entity\Scann $scanns)
    {
        $this->scanns[] = $scanns;
    
        return $this;
    }

    /**
     * Remove scanns
     *
     * @param \Amb\GlobalBundle\Entity\Scann $scanns
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
}