<?php

namespace Amb\ContratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class ContratType extends AbstractType
{
 
    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('reference', 'text')
            ->add('date_debut','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => false,
                ))
            ->add('montant',  'money', array('precision' => 2, 'required' => true))
            ->add('commentaire', 'textarea', array('required' => false))
            ->add('date_resiliation','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => false,
                ))
            ->add('fournisseur', 'entity', array(
                'class' => 'AmbDebitBundle:Fournisseur',
                'property' => 'raison_social',
                'empty_value' => 'Choisissez une option',
                'required' => True,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->where('i.is_intervenant = :yes')
                        ->setParameters(array('yes' => '1'))
                        ->orderBy('i.raison_social', 'ASC');
                    }
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\ContratBundle\Entity\Contrat'
        ));
    }

    public function getName()
    {
        return 'amb_contratbundle_contrattype';
    }
}