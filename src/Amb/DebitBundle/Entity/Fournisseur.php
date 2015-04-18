<?php

namespace Amb\DebitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\DebitBundle\Entity\Fournisseur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\DebitBundle\Entity\FournisseurRepository")
 */
class Fournisseur
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
     * @var \DateTime $raison_social
     *
     * @ORM\Column(name="raison_social", type="string", length=255)
     */
    private $raison_social;
    
    /**
     * @var \DateTime $is_intervenant
     *
     * @ORM\Column(name="is_intervenant", type="boolean", nullable=true)
     */
    private $is_intervenant;
    
    /**
     * @var \DateTime $identifiant_fiscal
     *
     * @ORM\Column(name="identifiant_fiscal", type="string", length=255, nullable=true)
     */
    private $identifiant_fiscal;
    
    /**
     * @var \DateTime $rib
     *
     * @ORM\Column(name="rib", type="string", length=255, nullable=true)
     */
    private $rib;

    /**
     * @var \DateTime $patente
     *
     * @ORM\Column(name="patente", type="string", length=255, nullable=true)
     */
    private $patente;
    
    /**
     * @var \DateTime $rc
     *
     * @ORM\Column(name="rc", type="string", length=255, nullable=true)
     */
    private $rc;
    
    /**
     * @var \DateTime $mission
     *
     * @ORM\Column(name="mission",type="text", nullable=true)
     */
    private $mission;

    /**
     * @var string $adress
     *
     * @ORM\Column(name="adress", type="text", nullable=true)
     */
    private $adress;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="ville", type="string", length=150, nullable=true)
     */
    private $ville;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="tel", type="string", length=100, nullable=true)
     */
    private $tel;

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
     * @var \DateTime $contact1
     *
     * @ORM\Column(name="contact1", type="string", length=255, nullable=true)
     */
    private $contact1;
    
    /**
     * @var \DateTime $fonction1
     *
     * @ORM\Column(name="fonction1", type="string", length=255, nullable=true)
     */
    private $fonction1;    

    /**
     * @var string $mobile1
     *
     * @ORM\Column(name="mobile1", type="string", length=100, nullable=true)
     */
    private $mobile1;

    /**
     * @var string $email1
     *
     * @ORM\Column(name="email1", type="string", length=255, unique=true, nullable=true)
     */
    private $email1;
    
    /**
     * @var \DateTime $contact2
     *
     * @ORM\Column(name="contact2", type="string", length=255, nullable=true)
     */
    private $contact2;
    
    /**
     * @var \DateTime $fonction2
     *
     * @ORM\Column(name="fonction2", type="string", length=255, nullable=true)
     */
    private $fonction2;    

    /**
     * @var string $mobile2
     *
     * @ORM\Column(name="mobile2", type="string", length=100, nullable=true)
     */
    private $mobile2;

    /**
     * @var string $email2
     *
     * @ORM\Column(name="email2", type="string", length=255, unique=true, nullable=true)
     */
    private $email2;
    
    /**
     * @var \DateTime $contact3
     *
     * @ORM\Column(name="contact3", type="string", length=255, nullable=true)
     */
    private $contact3;
    
    /**
     * @var \DateTime $fonction3
     *
     * @ORM\Column(name="fonction3", type="string", length=255, nullable=true)
     */
    private $fonction3;    

    /**
     * @var string $mobile3
     *
     * @ORM\Column(name="mobile3", type="string", length=100, nullable=true)
     */
    private $mobile3;

    /**
     * @var string $email3
     *
     * @ORM\Column(name="email3", type="string", length=255, unique=true, nullable=true)
     */
    private $email3;

    /**
     * @var \DateTime $contact4
     *
     * @ORM\Column(name="contact4", type="string", length=255, nullable=true)
     */
    private $contact4;
    
    /**
     * @var \DateTime $fonction4
     *
     * @ORM\Column(name="fonction4", type="string", length=255, nullable=true)
     */
    private $fonction4;    

    /**
     * @var string $mobile4
     *
     * @ORM\Column(name="mobile4", type="string", length=100, nullable=true)
     */
    private $mobile4;

    /**
     * @var string $email4
     *
     * @ORM\Column(name="email4", type="string", length=255, unique=true, nullable=true)
     */
    private $email4;
    /**
     * @var string $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="fournisseur")
     */
    private $depenses;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\ContratBundle\Entity\Contrat", mappedBy="fournisseur")
     */
    private $contrats;

    
    /**
     * @ORM\OneToMany(targetEntity="Amb\GlobalBundle\Entity\Scann", mappedBy="fournisseur")
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
     * Constructor
     */
    public function __construct()
    {
        $this->depenses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set raison_social
     *
     * @param string $raisonSocial
     * @return Fournisseur
     */
    public function setRaisonSocial($raisonSocial)
    {
        $this->raison_social = $raisonSocial;
    
        return $this;
    }

    /**
     * Get raison_social
     *
     * @return string 
     */
    public function getRaisonSocial()
    {
        return $this->raison_social;
    }

    /**
     * Set is_intervenant
     *
     * @param boolean $isIntervenant
     * @return Fournisseur
     */
    public function setIsIntervenant($isIntervenant)
    {
        $this->is_intervenant = $isIntervenant;
    
        return $this;
    }

    /**
     * Get is_intervenant
     *
     * @return boolean 
     */
    public function getIsIntervenant()
    {
        return $this->is_intervenant;
    }

    /**
     * Set identifiant_fiscal
     *
     * @param string $identifiantFiscal
     * @return Fournisseur
     */
    public function setIdentifiantFiscal($identifiantFiscal)
    {
        $this->identifiant_fiscal = $identifiantFiscal;
    
        return $this;
    }

    /**
     * Get identifiant_fiscal
     *
     * @return string 
     */
    public function getIdentifiantFiscal()
    {
        return $this->identifiant_fiscal;
    }

    /**
     * Set patente
     *
     * @param string $patente
     * @return Fournisseur
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;
    
        return $this;
    }

    /**
     * Get patente
     *
     * @return string 
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * Set rc
     *
     * @param string $rc
     * @return Fournisseur
     */
    public function setRc($rc)
    {
        $this->rc = $rc;
    
        return $this;
    }

    /**
     * Get rc
     *
     * @return string 
     */
    public function getRc()
    {
        return $this->rc;
    }

    /**
     * Set mission
     *
     * @param string $mission
     * @return Fournisseur
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    
        return $this;
    }

    /**
     * Get mission
     *
     * @return string 
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Fournisseur
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
     * @return Fournisseur
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
     * Set fax
     *
     * @param string $fax
     * @return Fournisseur
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
     * @return Fournisseur
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
     * Set contact1
     *
     * @param string $contact1
     * @return Fournisseur
     */
    public function setContact1($contact1)
    {
        $this->contact1 = $contact1;
    
        return $this;
    }

    /**
     * Get contact1
     *
     * @return string 
     */
    public function getContact1()
    {
        return $this->contact1;
    }

    /**
     * Set fonction1
     *
     * @param string $fonction1
     * @return Fournisseur
     */
    public function setFonction1($fonction1)
    {
        $this->fonction1 = $fonction1;
    
        return $this;
    }

    /**
     * Get fonction1
     *
     * @return string 
     */
    public function getFonction1()
    {
        return $this->fonction1;
    }

    /**
     * Set mobile1
     *
     * @param string $mobile1
     * @return Fournisseur
     */
    public function setMobile1($mobile1)
    {
        $this->mobile1 = $mobile1;
    
        return $this;
    }

    /**
     * Get mobile1
     *
     * @return string 
     */
    public function getMobile1()
    {
        return $this->mobile1;
    }

    /**
     * Set email1
     *
     * @param string $email1
     * @return Fournisseur
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;
    
        return $this;
    }

    /**
     * Get email1
     *
     * @return string 
     */
    public function getEmail1()
    {
        return $this->email1;
    }

    /**
     * Set contact2
     *
     * @param string $contact2
     * @return Fournisseur
     */
    public function setContact2($contact2)
    {
        $this->contact2 = $contact2;
    
        return $this;
    }

    /**
     * Get contact2
     *
     * @return string 
     */
    public function getContact2()
    {
        return $this->contact2;
    }

    /**
     * Set fonction2
     *
     * @param string $fonction2
     * @return Fournisseur
     */
    public function setFonction2($fonction2)
    {
        $this->fonction2 = $fonction2;
    
        return $this;
    }

    /**
     * Get fonction2
     *
     * @return string 
     */
    public function getFonction2()
    {
        return $this->fonction2;
    }

    /**
     * Set mobile2
     *
     * @param string $mobile2
     * @return Fournisseur
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
     * Set email2
     *
     * @param string $email2
     * @return Fournisseur
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    
        return $this;
    }

    /**
     * Get email2
     *
     * @return string 
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * Set contact3
     *
     * @param string $contact3
     * @return Fournisseur
     */
    public function setContact3($contact3)
    {
        $this->contact3 = $contact3;
    
        return $this;
    }

    /**
     * Get contact3
     *
     * @return string 
     */
    public function getContact3()
    {
        return $this->contact3;
    }

    /**
     * Set fonction3
     *
     * @param string $fonction3
     * @return Fournisseur
     */
    public function setFonction3($fonction3)
    {
        $this->fonction3 = $fonction3;
    
        return $this;
    }

    /**
     * Get fonction3
     *
     * @return string 
     */
    public function getFonction3()
    {
        return $this->fonction3;
    }

    /**
     * Set mobile3
     *
     * @param string $mobile3
     * @return Fournisseur
     */
    public function setMobile3($mobile3)
    {
        $this->mobile3 = $mobile3;
    
        return $this;
    }

    /**
     * Get mobile3
     *
     * @return string 
     */
    public function getMobile3()
    {
        return $this->mobile3;
    }

    /**
     * Set email3
     *
     * @param string $email3
     * @return Fournisseur
     */
    public function setEmail3($email3)
    {
        $this->email3 = $email3;
    
        return $this;
    }

    /**
     * Get email3
     *
     * @return string 
     */
    public function getEmail3()
    {
        return $this->email3;
    }

    /**
     * Set contact4
     *
     * @param string $contact4
     * @return Fournisseur
     */
    public function setContact4($contact4)
    {
        $this->contact4 = $contact4;
    
        return $this;
    }

    /**
     * Get contact4
     *
     * @return string 
     */
    public function getContact4()
    {
        return $this->contact4;
    }

    /**
     * Set fonction4
     *
     * @param string $fonction4
     * @return Fournisseur
     */
    public function setFonction4($fonction4)
    {
        $this->fonction4 = $fonction4;
    
        return $this;
    }

    /**
     * Get fonction4
     *
     * @return string 
     */
    public function getFonction4()
    {
        return $this->fonction4;
    }

    /**
     * Set mobile4
     *
     * @param string $mobile4
     * @return Fournisseur
     */
    public function setMobile4($mobile4)
    {
        $this->mobile4 = $mobile4;
    
        return $this;
    }

    /**
     * Get mobile4
     *
     * @return string 
     */
    public function getMobile4()
    {
        return $this->mobile4;
    }

    /**
     * Set email4
     *
     * @param string $email4
     * @return Fournisseur
     */
    public function setEmail4($email4)
    {
        $this->email4 = $email4;
    
        return $this;
    }

    /**
     * Get email4
     *
     * @return string 
     */
    public function getEmail4()
    {
        return $this->email4;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Fournisseur
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
     * Add depenses
     *
     * @param \Amb\DebitBundle\Entity\Depense $depenses
     * @return Fournisseur
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
    
        $depenses->setFournisseur($this);
    
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
     * Set ville
     *
     * @param string $ville
     * @return Fournisseur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Add contrats
     *
     * @param \Amb\ContratBundle\Entity\Contrat $contrats
     * @return Fournisseur
     */
    public function addContrat(\Amb\ContratBundle\Entity\Contrat $contrats)
    {
        $this->contrats[] = $contrats;
        $contrats->setFournisseur($this);
        return $this;
    }

    /**
     * Remove contrats
     *
     * @param \Amb\ContratBundle\Entity\Contrat $contrats
     */
    public function removeContrat(\Amb\ContratBundle\Entity\Contrat $contrats)
    {
        $this->contrats->removeElement($contrats);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContrats()
    {
        return $this->contrats;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Fournisseur
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
     * @return Fournisseur
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
     * Set rib
     *
     * @param string $rib
     * @return Fournisseur
     */
    public function setRib($rib)
    {
        $this->rib = $rib;
    
        return $this;
    }

    /**
     * Get rib
     *
     * @return string 
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Add scanns
     *
     * @param \Amb\GlobalBundle\Entity\Scanns $scanns
     * @return Fournisseur
     */
    public function addScann(\Amb\GlobalBundle\Entity\Scann $scanns)
    {
        $this->scanns[] = $scanns;
        $scanns->setFournisseur($this);

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
}