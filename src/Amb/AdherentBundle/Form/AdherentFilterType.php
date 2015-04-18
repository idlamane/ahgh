<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class AdherentFilterType extends AbstractType
{

 
    public function __construct()
    {
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut', 'filter_choice', array(
                'choices' => array('1'=>'Tous',
                                   '2'=>'En cours',
                                   '3'=>'Archives'),
            ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering')
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_adherentfiltertype';
    }
}
