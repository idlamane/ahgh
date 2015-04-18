<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class AdherentType extends AbstractType
{
    private $civilite;
    private $etat_civile;
 
    public function __construct($civilite=null, $etat_civile=null)
    {
        $this->civilite = $civilite;
        $this->etat_civile = $etat_civile;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('civilite', 'choice', array(
                        'choices' => $this->civilite, /*'data' => 1*/))
            ->add('nom_prenom', 'text', array('required' => true))
            ->add('cin', 'text', array('required' => true))
            ->add('date_n','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => false,
                ))
            ->add('adress', 'text', array('required' => false))
            ->add('tel', 'text', array('required' => false))
            ->add('tel2', 'text', array('required' => false))
            ->add('mobile', 'text', array('required' => false))
            ->add('mobile2', 'text', array('required' => false))
            ->add('fax', 'text', array('required' => false))
            ->add('email' ,'email', array('required' => false))
            ->add('profession', 'text', array('required' => false))
            ->add('banque', 'text', array('required' => true))
            ->add('n_compte_bq', 'text', array('required' => false))
            ->add('attest_rib', 'text', array('required' => true))
            ->add('etat_civile', 'choice', array(
                        'choices' => $this->etat_civile, /*'data' => 1*/))
            ->add('nom_pere', 'text', array('required' => false))
            ->add('nom_mere', 'text', array('required' => false))
            ->add('nom_conjoint', 'text', array('required' => false))
            ->add('cin_conj', 'text', array('required' => false))
            ->add('date_n_conj','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => false,
                ))
            ->add('date_mariage','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                'required' => false,
                ))
            ->add('nb_enfant', 'integer', array('required' => false))
            ->add('prenom_enf', 'text', array('required' => false))
            ->add('commentaire', 'textarea', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\AdherentBundle\Entity\Adherent'
        ));
    }

    public function getName()
    {
        return 'amb_adherentbundle_adherenttype';
    }
}
