<?php

namespace Amb\GlobalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class JournalFilterType extends AbstractType
{
 
    public function __construct()
    {
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date_debut = '01-01-'.date('Y');
        $date_fin = '31-12-'.date('Y');
        $builder
            ->add('date_debut','filter_date',array(
                'data' => new \Datetime($date_debut),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                $filterBuilder->andWhere('e.date_operation >= \''.$values['value']->format('Y-m-d').'\'' );

            },
            ))
            ->add('date_fin','filter_date',array(
                'data' => new \Datetime($date_fin),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                $filterBuilder->andWhere('e.date_operation <= \''.$values['value']->format('Y-m-d').'\'' );

            },
            ))
            ->add('banque', 'filter_entity', array(
                                'class' => 'AmbParamBundle:Banque',
                                'property' => 'nom',
                                'empty_value' => 'Choisissez une option',
                                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                                $filterBuilder->andWhere('e.banque = '.$values['value'].'' );

                            },
                            ))
            ->add('mot_cle', 'filter_text',array(
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                $filterBuilder->andWhere('(e.libelle LIKE \'%'.$values['value'].'%\' OR e.commentaire LIKE \'%'.$values['value'].'%\')' );

            },
            ))
            ->add('adh', 'filter_text')
            ->add('mode', 'filter_choice', array(
                'choices' => array('ESPECE'=>'ESPECE', 
                                   'CHEQUE'=>'CHEQUE', 
                                   'VIREMENT'=>'VIREMENT', 
                                   'PRELEVEMENT'=>'PRELEVEMENT', 
                                   'EFFET'=>'EFFET')
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
        return 'amb_debitbundle_caissefiltertype';
    }
}
