<?php

namespace Amb\CreditBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutreEncaissementType extends AbstractType
{
    private $mode_encaissement;
    private $source;
    private $compte;
 
    public function __construct($mode_encaissement=null, $source=null, $compte=null)
    {
        $this->mode_encaissement = $mode_encaissement;
        $this->source = $source;
        $this->compte = $compte;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('compte', 'choice', array(
                        'choices' => $this->compte, /*'data' => 1*/))
            ->add('source', 'choice', array(
                        'choices' => $this->source, /*'data' => 1*/))
            ->add('mode_encaissement', 'choice', array(
                        'choices' => $this->mode_encaissement, /*'data' => 1*/))
            ->add('num_piece', 'text', array('required' => false))
            ->add('libelle', 'text', array('required' => false))
            ->add('montant', 'money', array('precision' => 2, 'required' => true))
            ->add('banque', 'entity', array(
                            'class' => 'AmbParamBundle:Banque',
                            'property' => 'nom',
                            'empty_value' => 'Choisissez une option',
                            'required' => true,
                        ))
            ->add('date_Operation','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\CreditBundle\Entity\Encaissement'
        ));
    }

    public function getName()
    {
        return 'amb_creditbundle_autreencaissementtype';
    }
}
