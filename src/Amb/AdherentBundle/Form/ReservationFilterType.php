<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class ReservationFilterType extends AbstractType
{
    private $immeuble;
    private $etage;
    private $imm_group;
    private $n_appt;

 
    public function __construct($immeuble=null, $etage=null,$imm_group=null,$n_appt=null)
    {
        $this->n_appt = $n_appt;
        $this->immeuble = $immeuble;
        $this->etage = $etage;
        $this->imm_group = $imm_group;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date_debut = date('d-m-Y');
        $builder
            ->add('date_finresrvation','filter_date',array(
                'data' => new \Datetime($date_debut),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                if ($values['value'] != null) {
                    $filterBuilder->andWhere('a.date_finresrvation <= \''.$values['value']->format('Y-m-d').'\'' );
                }
               

            },
            ))
            ->add('immeuble', 'filter_choice', array(
                'choices' => $this->immeuble,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('a.immeuble LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('etage', 'filter_choice', array(
                'choices' => $this->etage,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('a.etage LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('imm_group', 'filter_choice', array(
                'choices' => $this->imm_group,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('a.imm_group LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('appartement', 'filter_choice', array(
                'choices' => $this->n_appt,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('a.appartement LIKE \'%'.$values['value'].'%\'' );

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
        return 'amb_debitbundle_reservationfiltertype';
    }
}
