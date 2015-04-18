<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class FournisseurType extends AbstractType
{
 
    public function __construct()
    {
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('raison_social', 'text')
            ->add('identifiant_fiscal', 'text', array('required' => false))
            ->add('rib', 'text', array('required' => false))
            ->add('is_intervenant', 'choice', array('choices'   => array('0' => 'Non', '1' => 'Oui')))
            ->add('patente', 'text', array('required' => false))
            ->add('rc', 'text', array('required' => false))
            ->add('adress', 'text', array('required' => false))
            ->add('ville', 'text', array('required' => false))
            ->add('mission', 'textarea', array('required' => false))
            ->add('tel', 'text', array('required' => false))
            ->add('fax', 'text', array('required' => false))
            ->add('email' ,'email', array('required' => false))
            ->add('contact1', 'text', array('required' => false))
            ->add('fonction1', 'text', array('required' => false))
            ->add('mobile1', 'text', array('required' => false))
            ->add('email1' ,'email', array('required' => false))
            ->add('contact2', 'text', array('required' => false))
            ->add('fonction2', 'text', array('required' => false))
            ->add('mobile2', 'text', array('required' => false))
            ->add('email2' ,'email', array('required' => false))
            ->add('contact3', 'text', array('required' => false))
            ->add('fonction3', 'text', array('required' => false))
            ->add('mobile3', 'text', array('required' => false))
            ->add('email3' ,'email', array('required' => false))
            ->add('contact4', 'text', array('required' => false))
            ->add('fonction4', 'text', array('required' => false))
            ->add('mobile4', 'text', array('required' => false))
            ->add('email4' ,'email', array('required' => false))
            ->add('commentaire', 'textarea', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\DebitBundle\Entity\Fournisseur'
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_fournisseurtype';
    }
}
