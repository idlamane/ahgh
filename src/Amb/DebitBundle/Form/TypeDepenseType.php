<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeDepenseType extends AbstractType
{
    private $compte_depense;
 
    public function __construct($compte_depense=null)
    {
        $this->compte_depense = $compte_depense;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('libelle', 'text')
            ->add('compte', 'choice', array(
                        'choices' => $this->compte_depense, /*'data' => 1*/))
            ->add('commentaire', 'textarea', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\DebitBundle\Entity\TypeDepense'
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_typedepensetype';
    }
}
