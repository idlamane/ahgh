<?php
namespace Amb\TraceBundle\Service;

use Amb\TraceBundle\Entity\Trace;
use Symfony\Component\Httpfoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Doctrine\ORM\EntityManager;

class Traceability 
{

  protected $container;
  protected $em;

    public function __construct(Container $container,EntityManager $dbalConnection)
    {
        $this->container = $container;
        $this->em = $dbalConnection;
    }

    public function AddTraceability($action, $description, $element_id, $value, $entity, $deleted = null)
    {
    	$trace = new Trace;
        $user = $this->container->get('security.context')->getToken()->getUser();


        //$trace->setRoute($route);
        $trace->setAction($action);
        $trace->setDescription($description);
        $trace->setElementId($element_id);
        $trace->setValue($value);
        $trace->setEntity($entity);
        $trace->setDeleted($deleted);
        $trace->setUser($user);

        $this->em->persist($trace);
        $this->em->flush();

    }
}