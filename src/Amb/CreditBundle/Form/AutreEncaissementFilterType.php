<?php

namespace Amb\CreditBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class AutreEncaissementFilterType extends AbstractType
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
        $date_debut = '01-01-'.date('Y');
        $date_fin = '31-12-'.date('Y');
        $builder
            ->add('date_debut','filter_date',array(
                'data' => new \Datetime($date_debut),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                if ($values['value'] != null) {
                    $filterBuilder->andWhere('a.date_Operation >= \''.$values['value']->format('Y-m-d').'\'' );
                }
               

            },
            ))
            ->add('date_fin','filter_date',array(
                'data' => new \Datetime($date_fin),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                if ($values['value'] != null) {    
                    $filterBuilder->andWhere('a.date_Operation <= \''.$values['value']->format('Y-m-d').'\'' );
                }
            },
            ))
            ->add('mode_encaissement', 'filter_choice', array(
                'choices' => $this->mode_encaissement,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('a.mode_encaissement LIKE \'%'.$values['value'].'%\'' );
                    }

                },
            ))
            ->add('source', 'filter_choice', array(
                'choices' => $this->source,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('a.source LIKE \'%'.$values['value'].'%\'' );
                    }    
                },
            ))
            ->add('compte', 'filter_choice', array(
                'choices' => $this->compte,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('a.compte LIKE \'%'.$values['value'].'%\'' );
                    }    
                },
            ))
            ->add('mot_cle', 'filter_text',array(
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('a.num_piece LIKE \'%'.$values['value'].'%\'' );
                    }

            },
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
        return 'amb_debitbundle_autreencaissementfiltertype';
    }
}
