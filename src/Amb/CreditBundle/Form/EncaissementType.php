<?php

namespace Amb\CreditBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncaissementType extends AbstractType
{
    private $mode_encaissement;
    private $type_encaissement;
    private $type_request;
 
    public function __construct($mode_encaissement=null, $type_encaissement=null, $type_request=null, $referer=null)
    {
        $this->mode_encaissement = $mode_encaissement;
        $this->type_encaissement = $type_encaissement;
        $this->type_request = $type_request;
        $this->referer = $referer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if($this->type_request == 'add'){
            $builder
                ->add('mode_encaissement', 'choice', array(
                            'choices' => $this->mode_encaissement, /*'data' => 1*/))
                ->add('num_piece', 'text', array('required' => false))
                ->add('banque_piece', 'text', array('required' => false))
                ->add('annee_gestion', 'choice', array(
                            'choices' => array('2012' => '2012',
                                               '2013' => '2013',
                                               '2014' => '2014',
                                               '2015' => '2015',
                                               '2016' => '2016',
                                               '2017' => '2017',
                                               '2018' => '2018',
                                               '2019' => '2019',
                                               '2020' => '2020'
                                            )
                            ,'required' => false
                            ,'empty_value' => 'Choisissez une annee'
                            ))
                ->add('type_encaissment', 'choice', array(
                            'choices' => $this->type_encaissement, /*'data' => 1*/))
                ->add('montant', 'money', array('precision' => 2, 'required' => true))
                ->add('banque', 'entity', array(
                                'class' => 'AmbParamBundle:Banque',
                                'property' => 'nom',
                                'empty_value' => 'Choisissez une option',
                                'required' => true,
                            ))
                ->add('date_Operation','date',array(
                    'data' => new \Datetime(),
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date'),
                    ))
            ;
        }else{
            $builder
                ->add('mode_encaissement', 'choice', array(
                            'choices' => $this->mode_encaissement, /*'data' => 1*/))
                ->add('num_piece', 'text', array('required' => false))
                ->add('banque_piece', 'text', array('required' => false))
                ->add('annee_gestion', 'choice', array(
                            'choices' => array('2012' => '2012',
                                               '2013' => '2013',
                                               '2014' => '2014',
                                               '2015' => '2015',
                                               '2016' => '2016',
                                               '2017' => '2017',
                                               '2018' => '2018',
                                               '2019' => '2019',
                                               '2020' => '2020'
                                            )
                            ,'required' => false
                            ,'empty_value' => 'Choisissez une annee'
                            ))
                ->add('type_encaissment', 'choice', array(
                            'choices' => $this->type_encaissement, /*'data' => 1*/))
                ->add('montant', 'money', array('precision' => 2, 'required' => true))
                ->add('banque', 'entity', array(
                                'class' => 'AmbParamBundle:Banque',
                                'property' => 'nom',
                                'empty_value' => 'Choisissez une option',
                                'required' => true,
                            ))
                ->add('date_Operation','date',array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array('class' => 'date'),
                    ))
                ->add('statut', 'choice', array(
                            'choices' => array('valid' => 'valid','invalid' => 'invalid','unpaid' => 'unpaid'),
                            'required' => true,
                            ))
                ->add('referer', 'hidden', array(
                    'data' => $this->referer,
                    'property_path' => FALSE,
                ))
            ;
        }      
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\CreditBundle\Entity\Encaissement'
        ));
    }

    public function getName()
    {
        return 'amb_creditbundle_encaissementtype';
    }
}
