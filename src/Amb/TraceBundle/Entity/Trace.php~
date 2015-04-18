<?php

namespace Amb\TraceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Amb\AdherentBundle\Entity\Adherent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Amb\TraceBundle\Entity\TraceRepository")
 */
class Trace
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
     * @var \DateTime $created_at
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @var integer $route
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=true)
     * 
     */
    private $route;

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255)
     */
    private $action;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string $element_id
     *
     * @ORM\Column(name="element_id", type="integer", nullable=true)
     */
    private $element_id;

    /**
     * @var string $value
     *
     * @ORM\Column(name="value", type="array", nullable=true)
     */
    private $value;

    /**
     * @var string $entity
     *
     * @ORM\Column(name="entity", type="string", length=255, nullable=true)
     */
    private $entity;


    /**
     * @var string $deleted
     *
     * @ORM\Column(name="deleted", type="integer", nullable=true)
     */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity="Amb\UserBundle\Entity\User", inversedBy="traces")
     * 
     */
    private $user;
    


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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Trace
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
     * Set route
     *
     * @param string $route
     * @return Trace
     */
    public function setRoute($route)
    {
        $this->route = $route;
    
        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Trace
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Trace
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set element_id
     *
     * @param integer $elementId
     * @return Trace
     */
    public function setElementId($elementId)
    {
        $this->element_id = $elementId;
    
        return $this;
    }

    /**
     * Get element_id
     *
     * @return integer 
     */
    public function getElementId()
    {
        return $this->element_id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Trace
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set entity
     *
     * @param string $entity
     * @return Trace
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return string 
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Trace
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set user
     *
     * @param \Amb\UserBundle\Entity\User $user
     * @return Trace
     */
    public function setUser(\Amb\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Amb\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}