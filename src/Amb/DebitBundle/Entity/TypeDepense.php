<?php

namespace Amb\DebitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\DebitBundle\Entity\TypeDepense
 *
 * @ORM\Table(name="typedepense")
 * @ORM\Entity(repositoryClass="Amb\DebitBundle\Entity\TypeDepenseRepository")
 */
class TypeDepense
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
     * @var integer $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @var integer $compte
     *
     * @ORM\Column(name="compte", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $compte;

    /**
     * @var integer $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     * 
     */
    private $commentaire;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Depense", mappedBy="typedepense")
     */
    private $depenses;
    
    /**
     * @ORM\OneToMany(targetEntity="Amb\DebitBundle\Entity\Caisse", mappedBy="typedepense")
     */
    private $caisses;

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
     * Set libelle
     *
     * @param string $libelle
     * @return TypeDepense
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
     * Set compte
     *
     * @param string $compte
     * @return TypeDepense
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
     * Set commentaire
     *
     * @param string $commentaire
     * @return TypeDepense
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
     * @return TypeDepense
     */
    public function addDepense(\Amb\DebitBundle\Entity\Depense $depenses)
    {
        $this->depenses[] = $depenses;
    	$depenses->setTypedepense($this);
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
     * @return TypeDepense
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
     * @return TypeDepense
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
     * Add caisses
     *
     * @param \Amb\DebitBundle\Entity\Caisse $caisses
     * @return TypeDepense
     */
    public function addCaisse(\Amb\DebitBundle\Entity\Caisse $caisses)
    {
        $this->caisses[] = $caisses;
    
        return $this;
    }

    /**
     * Remove caisses
     *
     * @param \Amb\DebitBundle\Entity\Caisse $caisses
     */
    public function removeCaisse(\Amb\DebitBundle\Entity\Caisse $caisses)
    {
        $this->caisses->removeElement($caisses);
    }

    /**
     * Get caisses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCaisses()
    {
        return $this->caisses;
    }
}