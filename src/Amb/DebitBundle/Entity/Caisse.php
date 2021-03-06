<?php

namespace Amb\DebitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\DebitBundle\Entity\Caisse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\DebitBundle\Entity\CaisseRepository")
 */
class Caisse
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
     * @var integer $justif
     *
     * @ORM\Column(name="justif", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $justif;

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
     * @var integer $piece
     *
     * @ORM\Column(name="piece", type="string", length=255, nullable=true)
     * 
     */
    private $piece;

    /**
     * @var integer $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", length=255, nullable=true)
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
     * @ORM\ManyToOne(targetEntity="Amb\DebitBundle\Entity\TypeDepense", inversedBy="depenses")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $typedepense;

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
     * Set justif
     *
     * @param string $justif
     * @return Caisse
     */
    public function setJustif($justif)
    {
        $this->justif = $justif;
    
        return $this;
    }

    /**
     * Get justif
     *
     * @return string 
     */
    public function getJustif()
    {
        return $this->justif;
    }

    /**
     * Set date_operation
     *
     * @param \DateTime $dateOperation
     * @return Caisse
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
     * @return Caisse
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
     * @return Caisse
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
     * @return Caisse
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Caisse
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
     * @return Caisse
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
     * Set typedepense
     *
     * @param \Amb\DebitBundle\Entity\TypeDepense $typedepense
     * @return Caisse
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
     * Set piece
     *
     * @param string $piece
     * @return Caisse
     */
    public function setPiece($piece)
    {
        $this->piece = $piece;
    
        return $this;
    }

    /**
     * Get piece
     *
     * @return string 
     */
    public function getPiece()
    {
        return $this->piece;
    }
}