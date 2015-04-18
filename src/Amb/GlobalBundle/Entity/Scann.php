<?php

namespace Amb\GlobalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Amb\GlobalBundle\Entity\Scann
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\GlobalBundle\Entity\ScannRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Scann
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
     * @ORM\Column(name="matricule", type="integer", nullable=true)
     */
    private $matricule;


    /**
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;


    /**
     * @var string $imm_group
     *
     * @ORM\Column(name="imm_group", type="string", length=255, nullable=true)
     */
    private $imm_group;


    /**
     * @var string $immeuble
     *
     * @ORM\Column(name="immeuble", type="string", length=255, nullable=true)
     */
    private $immeuble;

    /**
     * @var string $commentaire
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string $type
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\adherent", inversedBy="Scanns")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\AdherentBundle\Entity\Adhesion", inversedBy="Scanns")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $adhesion;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\DebitBundle\Entity\Fournisseur", inversedBy="Scanns")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $fournisseur;

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

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/scann';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->path);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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
     * Set matricule
     *
     * @param integer $matricule
     * @return Scann
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
     * Set libelle
     *
     * @param string $libelle
     * @return Scann
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Scann
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
     * @return Scann
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
     * Set adherent
     *
     * @param \Amb\AdherentBundle\Entity\adherent $adherent
     * @return Scann
     */
    public function setAdherent(\Amb\AdherentBundle\Entity\adherent $adherent = null)
    {
        $this->adherent = $adherent;
    
        return $this;
    }

    /**
     * Get adherent
     *
     * @return \Amb\AdherentBundle\Entity\adherent 
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set adhesion
     *
     * @param \Amb\AdherentBundle\Entity\Adhesion $adhesion
     * @return Scann
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
     * Set fournisseur
     *
     * @param \Amb\DebitBundle\Entity\Fournisseur $fournisseur
     * @return Scann
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
     * Set path
     *
     * @param string $path
     * @return Scann
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Scann
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
     * Set type
     *
     * @param string $type
     * @return Scann
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set imm_group
     *
     * @param string $immGroup
     * @return Scann
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
     * Set immeuble
     *
     * @param string $immeuble
     * @return Scann
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
}