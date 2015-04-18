<?php

namespace Amb\GlobalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class ScannType extends AbstractType
{
    private $scan_frs;
    private $type;
    private $imm;
    private $imm_group;
 
    public function __construct($type, $scan_frs=null, $imm_group=null, $imm=null)
    {
        $this->scan_frs = $scan_frs;
        $this->type = $type;
        $this->imm_group = $imm_group;
        $this->imm = $imm;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('libelle', 'text', array('required' => true))
            ->add('commentaire', 'textarea', array('required' => false))
            ->add('file')
        ;
        if($this->type == "frs"){
            $builder->add('type', 'choice', array(
                        'choices' => $this->scan_frs, /*'data' => 1*/))
                    ->add('imm_group', 'choice', array(
                        'choices' => $this->imm_group,
                        'empty_value' => 'Choisissez une valeur',
                        'required' => false, /*'data' => 1*/))
                    ->add('immeuble', 'choice', array(
                        'choices' => $this->imm,
                        'empty_value' => 'Choisissez une valeur',
                        'required' => false, /*'data' => 1*/));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\GlobalBundle\Entity\Scann'
        ));
    }

    public function getName()
    {
        return 'amb_globalbundle_scanntype';
    }
}
