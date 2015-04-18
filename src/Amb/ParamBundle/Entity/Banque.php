<?php

namespace Amb\ParamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\ParamBundle\Entity\Banque
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\ParamBundle\Entity\BanqueRepository")
 */
class Banque
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $nom;

    /**
     * @var integer $banque
     *
     * @ORM\Column(name="banque", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $banque;

    /**
     * @var integer $agence
     *
     * @ORM\Column(name="agence", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $agence;

    /**
     * @var integer $n_compte
     *
     * @ORM\Column(name="n_compte", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    protected $n_compte;

    /**
     * @var string $adress
     *
     * @ORM\Column(name="adress", type="text")
     */
    protected $adress;

    /**
     * @var string $tel1
     *
     * @ORM\Column(name="tel1", type="string", length=100)
     */
    protected $tel1;

    /**
     * @var string $tel2
     *
     * @ORM\Column(name="tel2", type="string", length=100, nullable=true)
     */
    protected $tel2;

    /**
     * @var string $tel3
     *
     * @ORM\Column(name="tel3", type="string", length=100, nullable=true)
     */
    protected $tel3;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=100, nullable=true)
     */
    protected $fax;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */
    protected $email;

    /**
     * @var integer $consultant
     *
     * @ORM\Column(name="consultant", type="string", length=50, nullable=true)
     * 
     */
    protected $consultant;

    /**
     * @var string $mobile_consult
     *
     * @ORM\Column(name="mobile_consult", type="string", length=100, nullable=true)
     */
    protected $mobile_consult;

    /**
     * @var string $email_consult
     *
     * @ORM\Column(name="email_consult", type="string", length=255, unique=true, nullable=true)
     */
    protected $email_consult;

    /**
     * @var integer $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     * 
     */
    protected $commentaire;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\CreditBundle\Entity\Encaissement", mappedBy="banque")
     */
    protected $encaissements;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="banque")
     */
    protected $depenses;

    /**
     * @var \DateTime $created_at
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $created_at;
    
    /**
     * @var \DateTime $updated_at
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updated_at;

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
     * Set banque
     *
     * @param string $banque
     * @return Banque
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
     * Set agence
     *
     * @param string $agence
     * @return Banque
     */
    public function setAgence($agence)
    {
        $this->agence = $agence;
    
        return $this;
    }

    /**
     * Get agence
     *
     * @return string 
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * Set n_compte
     *
     * @param string $nCompte
     * @return Banque
     */
    public function setNCompte($nCompte)
    {
        $this->n_compte = $nCompte;
    
        return $this;
    }

    /**
     * Get n_compte
     *
     * @return string 
     */
    public function getNCompte()
    {
        return $this->n_compte;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Banque
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
     * Set tel1
     *
     * @param string $tel1
     * @return Banque
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;
    
        return $this;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Banque
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
     * Set tel3
     *
     * @param string $tel3
     * @return Banque
     */
    public function setTel3($tel3)
    {
        $this->tel3 = $tel3;
    
        return $this;
    }

    /**
     * Get tel3
     *
     * @return string 
     */
    public function getTel3()
    {
        return $this->tel3;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Banque
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
     * @return Banque
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
     * Set consultant
     *
     * @param string $consultant
     * @return Banque
     */
    public function setConsultant($consultant)
    {
        $this->consultant = $consultant;
    
        return $this;
    }

    /**
     * Get consultant
     *
     * @return string 
     */
    public function getConsultant()
    {
        return $this->consultant;
    }

    /**
     * Set email_consult
     *
     * @param string $emailConsult
     * @return Banque
     */
    public function setEmailConsult($emailConsult)
    {
        $this->email_consult = $emailConsult;
    
        return $this;
    }

    /**
     * Get email_consult
     *
     * @return string 
     */
    public function getEmailConsult()
    {
        return $this->email_consult;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Banque
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
     * @return Banque
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
        $depenses->setBanque($this);
    
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
     * Set mobile_consult
     *
     * @param string $mobileConsult
     * @return Banque
     */
    public function setMobileConsult($mobileConsult)
    {
        $this->mobile_consult = $mobileConsult;
    
        return $this;
    }

    /**
     * Get mobile_consult
     *
     * @return string 
     */
    public function getMobileConsult()
    {
        return $this->mobile_consult;
    }

    /**
     * Add encaissements
     *
     * @param \Amb\CreditBundle\Entity\Encaissement $encaissements
     * @return Banque
     */
    public function addEncaissement(\Amb\CreditBundle\Entity\Encaissement $encaissements)
    {
        $this->encaissements[] = $encaissements;
        $encaissements->setBanque($this);
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
     * Set nom
     *
     * @param string $nom
     * @return Banque
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Banque
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
     * @return Banque
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
}