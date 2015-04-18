<?php

namespace Amb\DebitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DepenseType extends AbstractType
{
    private $mode_retrait;
    private $type;
    private $referer;
    private $frs;

 
    public function __construct($params = array())
    {
        $this->mode_retrait = isset($params['mode_retrait']) ? $params['mode_retrait'] : NULL;
        $this->type = isset($params['type']) ? $params['type'] : NULL;
        $this->referer = isset($params['referer']) ? $params['referer'] : NULL;
        $this->frs = isset($params['frs']) ? $params['frs'] : NULL;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $frsid = $this->frs;
        switch ($this->type) {
            case 'caisse':
                $builder
                    ->add('mode_retrait', 'choice', array(
                                'choices' => $this->mode_retrait, /*'data' => 1*/))
                    ->add('n_piece', 'text', array('required' => false))
                    ->add('libelle', 'text')
                    ->add('banque', 'entity', array(
                                    'class' => 'AmbParamBundle:Banque',
                                    'property' => 'nom',
                                ))
                    ->add('date_Operation','date',array(
                        //'data' => new \Datetime(),
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'attr' => array('class' => 'date'),
                        ))
                    ->add('montant',  'money', array('precision' => 2, 'required' => true))
                    ->add('commentaire', 'textarea', array('required' => false))
                    ->add('referer', 'hidden', array(
                        'data' => $this->referer,
                        'property_path' => FALSE,
                    ))
                ;
                break;
            case 'gestion':
                $builder
                    ->add('n_piece', 'text', array('required' => false))
                    ->add('libelle', 'text')
                    ->add('facture', 'text', array('required' => false))
                    ->add('mode_retrait', 'choice', array(
                                'choices' => $this->mode_retrait, /*'data' => 1*/))
                    ->add('banque', 'entity', array(
                                    'class' => 'AmbParamBundle:Banque',
                                    'property' => 'nom',
                                ))
                    ->add('date_Operation','date',array(
                        //'data' => new \Datetime(),
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'attr' => array('class' => 'date'),
                        ))
                    ->add('fournisseur', 'entity', array(
                                    'class' => 'AmbDebitBundle:Fournisseur',
                                    'property' => 'raison_social',
                                    'empty_value' => 'Choisissez une option',
                                    'required' => false,
                                    'query_builder' => function(EntityRepository $er) {
                                        return $er->createQueryBuilder('f')
                                            ->orderBy('f.raison_social', 'ASC');
                                        }
                                ))
                    ->add('typedepense', 'entity', array(
                                    'class' => 'AmbDebitBundle:TypeDepense',
                                    'property' => 'libelle',
                                    'query_builder' => function(EntityRepository $er) {
                                        return $er->createQueryBuilder('i')
                                            ->where('i.compte = :compte')
                                            ->setParameters(array('compte' => 'GESTION'))
                                            ->orderBy('i.compte', 'ASC');
                                        }
                                ))
                    ->add('montant',  'money', array('precision' => 2, 'required' => true))
                    ->add('commentaire', 'textarea', array('required' => false))
                    ->add('referer', 'hidden', array(
                        'data' => $this->referer,
                        'property_path' => FALSE,
                    ))
                ;
                break;
            case 'amortissement':
                if ($this->frs!=null) {
                    $builder
                        ->add('mode_retrait', 'choice', array(
                                    'choices' => $this->mode_retrait, /*'data' => 1*/))
                        ->add('n_piece', 'text', array('required' => false))
                        ->add('libelle', 'text')
                        ->add('facture', 'text', array('required' => false))
                        ->add('mode_retrait', 'choice', array(
                                    'choices' => $this->mode_retrait, /*'data' => 1*/))
                        ->add('banque', 'entity', array(
                                        'class' => 'AmbParamBundle:Banque',
                                        'property' => 'nom',
                                    ))
                        ->add('fournisseur', 'entity', array(
                                        'class' => 'AmbDebitBundle:Fournisseur',
                                        'property' => 'raison_social',
                                        'required' => true,
                                        'query_builder' => function(EntityRepository $er) use($frsid){
                                            return $er->createQueryBuilder('i')
                                                ->where('i.id = :frs')
                                                ->setParameters(array('frs' => $frsid));
                                            }    
                                    ))
                        ->add('date_Operation','date',array(
                            //'data' => new \Datetime(),
                            'widget' => 'single_text',
                            'format' => 'dd-MM-yyyy',
                            'attr' => array('class' => 'date'),
                            ))
                        ->add('contrat', 'entity', array(
                                        'class' => 'AmbContratBundle:Contrat',
                                        'property' => 'reference',
                                        'required' => true,
                                        'query_builder' => function(EntityRepository $er) use($frsid){
                                            return $er->createQueryBuilder('i')
                                                ->where('i.fournisseur = :frs ')
                                                ->setParameters(array('frs' =>  $frsid));
                                            }    
                                    ))
                        ->add('typedepense', 'entity', array(
                                        'class' => 'AmbDebitBundle:TypeDepense',
                                        'property' => 'libelle',
                                        'empty_value' => 'Choisissez une option',
                                        'required' => true,
                                        'query_builder' => function(EntityRepository $er) {
                                            return $er->createQueryBuilder('i')
                                                ->where('i.compte = :compte')
                                                ->setParameters(array('compte' => 'AMORTISSEMENT'))
                                                ->orderBy('i.compte', 'ASC');
                                            }    
                                    ))
                        ->add('montant',  'money', array('precision' => 2, 'required' => true))
                        ->add('commentaire', 'textarea', array('required' => false))
                        ->add('referer', 'hidden', array(
                            'data' => $this->referer,
                            'property_path' => FALSE,
                        ))
                        ;
                        break;
                }else{
                    $builder
                        ->add('mode_retrait', 'choice', array(
                                    'choices' => $this->mode_retrait, /*'data' => 1*/))
                        ->add('n_piece', 'text', array('required' => false))
                        ->add('libelle', 'text')
                        ->add('facture', 'text', array('required' => false))
                        ->add('mode_retrait', 'choice', array(
                                    'choices' => $this->mode_retrait, /*'data' => 1*/))
                        ->add('banque', 'entity', array(
                                        'class' => 'AmbParamBundle:Banque',
                                        'property' => 'nom',
                                    ))
                        ->add('fournisseur', 'entity', array(
                                        'class' => 'AmbDebitBundle:Fournisseur',
                                        'property' => 'raison_social',
                                        'empty_value' => 'Choisissez une option',
                                        'required' => true,
                                        'query_builder' => function(EntityRepository $er) {
                                            return $er->createQueryBuilder('f')
                                                ->orderBy('f.raison_social', 'ASC');
                                            }
                                    ))
                        ->add('date_Operation','date',array(
                            //'data' => new \Datetime(),
                            'widget' => 'single_text',
                            'format' => 'dd-MM-yyyy',
                            'attr' => array('class' => 'date'),
                            ))
                        ->add('typedepense', 'entity', array(
                                        'class' => 'AmbDebitBundle:TypeDepense',
                                        'property' => 'libelle',
                                        'query_builder' => function(EntityRepository $er) {
                                            return $er->createQueryBuilder('i')
                                                ->where('i.compte = :compte')
                                                ->setParameters(array('compte' => 'AMORTISSEMENT'))
                                                ->orderBy('i.compte', 'ASC');
                                            }    
                                    ))
                        ->add('montant',  'money', array('precision' => 2, 'required' => true))
                        ->add('commentaire', 'textarea', array('required' => false))
                        ->add('referer', 'hidden', array(
                            'data' => $this->referer,
                            'property_path' => FALSE,
                        ))
                        ;
                        break;

                }
        }
    }
    function getfrsid() {
        return $this->frs;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\DebitBundle\Entity\Depense'
        ));
    }

    public function getName()
    {
        return 'amb_debitbundle_depensetype';
    }
}
