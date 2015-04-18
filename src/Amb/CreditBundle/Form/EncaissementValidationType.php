<?php

namespace Amb\CreditBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncaissementValidationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        
        $builder
            ->add('banque', 'entity', array(
                            'class' => 'AmbParamBundle:Banque',
                            'property' => 'nom',
                        ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\CreditBundle\Entity\Encaissement'
        ));
    }

    public function getName()
    {
        return 'amb_creditbundle_encaissementvalidationtype';
    }
}
