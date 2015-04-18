<?php
namespace Amb\TraceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Amb\TraceBundle\Entity\Trace;
use JMS\SecurityExtraBundle\Annotation\Secure;

class TraceController extends Controller
{

    /*public function AddTraceability($route, $action, $description, $element_id, $value, $entity, $deleted = null)
    {
    	$trace = new Trace;
    	
    	$repository = $this->getDoctrine()
                           ->getRepository('AmbUserBundle:User');
        $user = $repository->findOneBy(array('id' => '1'));


        $trace->setRoute($route);
        $trace->setAction($action);
        $trace->setDescription($description);
        $trace->setElementId($element_id);
        $trace->setValue($value);
        $trace->setEntity($entity);
        $trace->setDeleted($deleted);
        $trace->setUser($user);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($trace);
        $em->flush();

    }*/
}
