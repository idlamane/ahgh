<?php

namespace Amb\ParamBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BanqueType extends AbstractType
{
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('nom', 'text')
            ->add('banque', 'text')
            ->add('agence', 'text', array('required' => false))
            ->add('n_compte', 'text')
            ->add('adress', 'textarea', array('required' => false))
            ->add('tel1', 'text', array('required' => false))
            ->add('tel2', 'text', array('required' => false))
            ->add('tel3', 'text', array('required' => false))
            ->add('fax', 'text', array('required' => false))
            ->add('email' ,'email', array('required' => false))
            ->add('consultant', 'text', array('required' => false))
            ->add('mobile_consult', 'text', array('required' => false))
            ->add('email_consult' ,'text', array('required' => false))
            ->add('commentaire', 'textarea', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\ParamBundle\Entity\Banque'
        ));
    }

    public function getName()
    {
        return 'amb_parambundle_banquetype';
    }
}
