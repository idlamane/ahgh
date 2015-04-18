<?php
// src/Amb/UserBundle/Entity/User.php
 
namespace Amb\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
    /**
     * @ORM\OneToMany(targetEntity="Amb\UserBundle\Entity\User", mappedBy="user")
     */
    private $traces;
    /**
     * Constructor
     */
    
    
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
     * Add traces
     *
     * @param \Amb\UserBundle\Entity\User $traces
     * @return User
     */
    public function addTrace(\Amb\UserBundle\Entity\User $traces)
    {
        $this->traces[] = $traces;
    	$traces->setUser($this);
        return $this;
    }

    /**
     * Remove traces
     *
     * @param \Amb\UserBundle\Entity\User $traces
     */
    public function removeTrace(\Amb\UserBundle\Entity\User $traces)
    {
        $this->traces->removeElement($traces);
    }

    /**
     * Get traces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTraces()
    {
        return $this->traces;
    }
}