<?php
// src/Amb/AdherentBundle/Coutappt/Coutapp.php;

namespace Amb\AdherentBundle\Coutappt;

class CoutAppt extends \Twig_Extension
{

  public function coutGlobal($surface_appt, $surface_terrace, $surface_jardin, $cout)
  {
    $coutglobal = ($surface_appt+$surface_terrace+($surface_jardin/2))*$cout;
    return $coutglobal ;
  }
  // Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
  public function getFunctions()
  {
    return array(
      'CoutGlobal' => new \Twig_Function_Method($this, 'coutGlobal')
    );
  }

  // La méthode getName() identifie votre extension Twig, elle est obligatoire
  public function getName()
  {
    return 'AmbCoutAppt';
  }
}