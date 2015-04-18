<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class CaisseType extends AbstractType
{
 
    public function __construct()
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date_Operation','date',array(
                'data' => new \Datetime(),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => true,
                ))
            ->add('justif', 'choice', array('choices'   => array('Non' => 'Non', 'Oui' => 'Oui')))
            ->add('libelle', 'text', array('required' => false))
            ->add('piece', 'text', array('required' => false))
            ->add('commentaire', 'textarea', array('required' => false))
            ->add('typedepense', 'entity', array(
                            'class' => 'AmbDebitBundle:TypeDepense',
                            'property' => 'libelle',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('i')
                                    ->orderBy('i.libelle', 'ASC');
                                }
                        ))
            ->add('montant',  'money', array(
                'precision' => 2, 
                'currency' => 'MAD', 
                'required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\DebitBundle\Entity\Caisse'
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_caissetype';
    }
}
