<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Expr;
use Doctrine\ORM\QueryBuilder;

class AdhesionFilterType extends AbstractType
{
    private $type_immeuble;
    private $immeuble;
    private $etage;
    private $type_appartement;
    private $appartement;
    private $imm_group;

 
    public function __construct($type_immeuble=null, $immeuble=null, $etage=null, $type_appartement=null, $imm_group=null, $appartement)
    {
        $this->type_immeuble = $type_immeuble;
        $this->immeuble = $immeuble;
        $this->etage = $etage;
        $this->appartement = $appartement;
        $this->type_appartement = $type_appartement;
        $this->imm_group = $imm_group;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_immeuble', 'filter_choice', array(
                'choices' => $this->type_immeuble,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('type_immeuble LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('immeuble', 'filter_choice', array(
                'choices' => $this->immeuble,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('immeuble LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('etage', 'filter_choice', array(
                'choices' => $this->etage,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('etage LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('type_appartement', 'filter_choice', array(
                'choices' => $this->type_appartement,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('type_appartement LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('imm_group', 'filter_choice', array(
                'choices' => $this->imm_group,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('imm_group LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('appartement', 'filter_choice', array(
                'choices' => $this->appartement,
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('appartement = '.$values['value'].' ' );

                },
            ))
            ->add('dossier', 'filter_choice', array(
                'choices' => array('complet'=>'complet', 'incomplet'=>'incomplet'),
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {

                    $filterBuilder->andWhere('dossier LIKE \'%'.$values['value'].'%\'' );

                },
            ))
            ->add('pourcent_vers_port', 'filter_choice', array(
                'choices' => array('1'=>'moins que 50%',
                                   '2'=>'entre 50% et 59%',
                                   '3'=>'entre 60% et 69%',
                                   '4'=>'entre 70% et 79%',
                                   '5'=>'entre 80% et 89%',
                                   '6'=>'entre 90% et 99%',
                                   '7'=>'100%'),
            ))
            ->add('adh_solde', 'filter_choice', array(
                'choices' => array('1'=>'Positif',
                                   '2'=>'Négatif',
                                   '3'=>'Nulle'),
            ))
            ->add('surface_appt', 'filter_entity', array(
                'class' => 'AmbAdherentBundle:Adhesion',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.id', 'ASC')
                        ->groupBy('a.surface_appt');
                },
                'property' => 'SurfaceAppt',
                'apply_filter' => function (QueryBuilder $filterBuilder, Expr $expr, $field, array $values) {
                    if ($values['value'] != null) {
                        $filterBuilder->andWhere('surface_appt ='.$values['value']->getId().' ' );
                    }
                },
            ))
            ->add('versement', 'filter_text')
            ->add('matricule', 'filter_text')

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
        return 'amb_debitbundle_adhesionfiltertype';
    }
}
