<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class DepenseFilterType extends AbstractType
{
    private $mode_retrait;
    private $type;
 
    public function __construct($type, $mode_retrait=null)
    {
        $this->mode_retrait = $mode_retrait;
        $this->type = $type;
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
            ->add('mode_retrait', 'filter_choice', array(
                'choices' => $this->mode_retrait,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.mode_retrait LIKE \'%'.$values['value'].'%\'' );
                    }
                    

                },
            ))
            ->add('fournisseur', 'filter_entity', array(
                'class' => 'AmbDebitBundle:Fournisseur',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                },
                'property' => 'RaisonSocial',
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.fournisseur ='.$values['value']->getId().' ' );
                    }
                },
            ))
            ->add('mot_cle', 'filter_text',array(
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                if ($values['value'] != null) {    
                    $filterBuilder->andWhere('(e.libelle LIKE \'%'.$values['value'].'%\' OR e.n_piece LIKE \'%'.$values['value'].'%\' OR e.facture LIKE \'%'.$values['value'].'%\')' );
                }
            },
            ))
        ;
        if($this->type == "all"){
            $builder->add('typedepense', 'filter_entity', array(
                'class' => 'AmbDebitBundle:TypeDepense',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC');
                },
                'property' => 'libelle',
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('e.typedepense ='.$values['value']->getId().' ' );
                    }
                },
            ));
        }
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
        return 'amb_debitbundle_depensefiltertype';
    }
}
