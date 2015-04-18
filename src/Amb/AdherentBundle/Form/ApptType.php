<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ApptType extends AbstractType
{
    private $imm_group;
    private $type_immeuble;
    private $immeuble;
    private $etage;
    private $appartement;
    private $type_appartement;
    private $is_reservation;
 
    public function __construct($imm_group=null, $type_immeuble=null, $immeuble=null, $etage=null, $appartement=null, $type_appartement=null)
    {
        $this->imm_group = $imm_group;
        $this->type_immeuble = $type_immeuble;
        $this->immeuble = $immeuble;
        $this->etage = $etage;
        $this->appartement = $appartement;
        $this->type_appartement = $type_appartement;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imm_group', 'choice', array(
                            'choices' => $this->imm_group,
                            'attr' => array('class' => 'locked')))
                ->add('type_immeuble', 'choice', array(
                            'choices' => $this->type_immeuble, /*'data' => 1*/))
                ->add('immeuble', 'choice', array(
                            'choices' => $this->immeuble,
                            'attr' => array('class' => 'locked')))
                ->add('etage', 'choice', array(
                            'choices' => $this->etage,
                            'attr' => array('class' => 'locked')))
                ->add('appartement', 'choice', array(
                            'choices' => $this->appartement,
                            'attr' => array('class' => 'locked')))
                ->add('type_appartement', 'choice', array(
                            'choices' => $this->type_appartement, /*'data' => 1*/))
                ->add('surface_appt', 'integer')
                ->add('surface_terrace', 'integer', array('data' => 0))
                ->add('surface_jardin', 'integer', array( 'data' => 0))
            ;
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\AdherentBundle\Entity\Adhesion',
        ));
    }

    public function getName()
    {
        return 'amb_adherentbundle_appttype';
    }
}
