<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DepenseDesistementType extends AbstractType
{
    private $mode_retrait;
    private $type_remboursement;
    private $annee;
 
    public function __construct($mode_retrait=null, $type_remboursement=null, $annee=null)
    {
        $this->mode_retrait = $mode_retrait;
        $this->type_remboursement = $type_remboursement;
        $this->annee = $annee;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mode_retrait', 'choice', array(
                        'choices' => $this->mode_retrait, /*'data' => 1*/))
            ->add('type_remboursement', 'choice', array(
                        'choices' => $this->type_remboursement, /*'data' => 1*/))
            ->add('annee_gestion', 'choice', array(
                        'choices' => $this->annee,
                        'required' => false,
                        'empty_value' => 'Choisissez une annee'))
            ->add('n_piece', 'text')
            ->add('libelle', 'text')
            ->add('date_Operation','date',array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'date'),
                ))
            ->add('mode_retrait', 'choice', array(
                        'choices' => $this->mode_retrait, /*'data' => 1*/))
            ->add('banque', 'entity', array(
                            'class' => 'AmbParamBundle:Banque',
                            'property' => 'nom',
                        ))
            ->add('montant',  'money', array('precision' => 2, 'required' => true))
            ->add('commentaire', 'textarea', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\DebitBundle\Entity\Depense'
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_depensedesistementtype';
    }
}
