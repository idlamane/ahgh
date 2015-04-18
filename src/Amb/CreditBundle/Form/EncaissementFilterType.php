<?php

namespace Amb\CreditBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class EncaissementFilterType extends AbstractType
{
    private $mode_encaissement;
    private $type_encaissement;
    private $annee_gestion;
    private $statut;

 
    public function __construct($mode_encaissement=null, $type_encaissement=null, $annee_gestion=null, $statut=null)
    {
        $this->mode_encaissement = $mode_encaissement;
        $this->type_encaissement = $type_encaissement;
        $this->annee_gestion = $annee_gestion;
        $this->statut = $statut;
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
                    $filterBuilder->andWhere('e.date_Operation >= \''.$values['value']->format('Y-m-d').'\'' );
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
                    $filterBuilder->andWhere('e.date_Operation <= \''.$values['value']->format('Y-m-d').'\'' );
                }
            },
            ))
            ->add('mode_encaissement', 'filter_choice', array(
                'choices' => $this->mode_encaissement,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.mode_encaissement LIKE \'%'.$values['value'].'%\'' );
                    }

                },
            ))
            ->add('type_encaissment', 'filter_choice', array(
                'choices' => $this->type_encaissement,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.type_encaissment LIKE \'%'.$values['value'].'%\'' );
                    }    
                },
            ))
            ->add('banque', 'filter_entity', array(
                            'class' => 'AmbParamBundle:Banque',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('a')
                                    ->orderBy('a.id', 'ASC');
                            },
                            'property' => 'nom',
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.banque = '.$values['value']->getId().' ' );
                    }    
                },
                        ))
            ->add('annee_gestion', 'filter_choice', array(
                'choices' => $this->annee_gestion,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.annee_gestion LIKE \'%'.$values['value'].'%\'' );
                    }    
                },
            ))
            ->add('statut', 'filter_choice', array(
                'choices' => $this->statut,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.statut LIKE \''.$values['value'].'%\'' );
                    }
                },
            ))
            ->add('mot_cle', 'filter_text',array(
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.num_piece LIKE \'%'.$values['value'].'%\'' );
                    }

            },
            ))
            ->add('matricule', 'filter_text',array(
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.matricule = '.$values['value'].'' );
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
        return 'amb_debitbundle_encaissementfiltertype';
    }
}
