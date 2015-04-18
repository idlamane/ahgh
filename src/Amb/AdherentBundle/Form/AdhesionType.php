<?php

namespace Amb\AdherentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AdhesionType extends AbstractType
{
    private $imm_group;
    private $type_immeuble;
    private $immeuble;
    private $etage;
    private $appartement;
    private $type_appartement;
    private $is_reservation;
    private $action;
 
    public function __construct($imm_group=null, $type_immeuble=null, $immeuble=null, $etage=null, $appartement=null, $type_appartement=null, $is_reservation=false, $action=null)
    {
        $this->imm_group = $imm_group;
        $this->type_immeuble = $type_immeuble;
        $this->immeuble = $immeuble;
        $this->etage = $etage;
        $this->appartement = $appartement;
        $this->type_appartement = $type_appartement;
        $this->is_reservation = $is_reservation;
        $this->action = $action;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($this->is_reservation == false ){
            if ($this->action == 'update') {
                $builder
                    ->add('matricule', 'integer', array(
                                'attr' => array('class' => 'matricule')
                                ))
                    ->add('dossier', 'choice', array(
                                'choices' => array('complet' => 'complet','incomplet' => 'incomplet')))
                    ->add('type_immeuble', 'choice', array(
                                'choices' => $this->type_immeuble, /*'data' => 1*/))
                ->add('imm_group', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('immeuble', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('etage', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('appartement', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                    ->add('type_appartement', 'choice', array(
                                'choices' => $this->type_appartement, /*'data' => 1*/))
                    ->add('surface_appt', 'integer')
                    ->add('surface_terrace', 'integer', array('data' => 0))
                    ->add('surface_jardin', 'integer', array( 'data' => 0))
                    ->add('cout',  'money', array('precision' => 2, 'required' => true))
                    ->add('type_echeance', 'choice', array(
                                'choices' => array('1' => 'MENSUEL',
                                                   '3' => 'TRIMESTRIEL',
                                                   '6' => 'SEMESTRIEL',
                                                   '12' => 'ANNUEL')))
                    ->add('nb_mois', 'integer', array('required' => false))
                    ->add('date_debut', 'date', array('required' => false))
                    ->add('echeance',  'money', array('precision' => 2, 'required' => false))
                    ->add('avance',  'money', array('precision' => 2, 'required' => false))
                    ->add('commentaire', 'textarea', array('required' => false))
                    ->add('date_debutresrvation', 'date', array('required' => false))
                    ->add('date_finresrvation', 'date', array('required' => false))
                    ->add('piece_reservation', 'text', array('required' => false))
                    ->add('montant_garantie',  'money', array('precision' => 2, 'required' => false))
                    ;
            }else{
                $builder
                    ->add('matricule', 'integer', array(
                                'attr' => array('class' => 'matricule')
                                ))
                    ->add('dossier', 'choice', array(
                                'choices' => array('complet' => 'complet','incomplet' => 'incomplet')))
                    ->add('imm_group', 'choice', array(
                                'choices' => $this->imm_group,
                                'attr' => array('class' => 'locked')))
                    ->add('type_immeuble', 'choice', array(
                                'choices' => $this->type_immeuble, /*'data' => 1*/))
                    ->add('immeuble', 'choice', array(
                                'choices' => $this->immeuble,
                                'attr' => array('class' => 'locked')))
                    ->add('etage', 'choice', array(
                                'choices' => $this->etage,
                                'attr' => array('class' => 'locked')))
                    ->add('appartement', 'choice', array(
                                'choices' => $this->appartement,
                                'attr' => array('class' => 'locked')))
                    ->add('type_appartement', 'choice', array(
                                'choices' => $this->type_appartement, /*'data' => 1*/))
                    ->add('surface_appt', 'integer')
                    ->add('surface_terrace', 'integer', array('data' => 0))
                    ->add('surface_jardin', 'integer', array( 'data' => 0))
                    ->add('cout',  'money', array('precision' => 2, 'required' => true))
                    ->add('type_echeance', 'choice', array(
                                'choices' => array('1' => 'MENSUEL',
                                                   '3' => 'TRIMESTRIEL',
                                                   '6' => 'SEMESTRIEL',
                                                   '12' => 'ANNUEL')))
                    ->add('nb_mois', 'integer', array('required' => false))
                    ->add('date_debut', 'date', array('required' => false))
                    ->add('echeance',  'money', array('precision' => 2, 'required' => false))
                    ->add('avance',  'money', array('precision' => 2, 'required' => false))
                    ->add('commentaire', 'textarea', array('required' => false))
                    ->add('date_debutresrvation', 'date', array('required' => false))
                    ->add('date_finresrvation', 'date', array('required' => false))
                    ->add('piece_reservation', 'text', array('required' => false))
                    ->add('montant_garantie',  'money', array('precision' => 2, 'required' => false))
                    ;

            }
        }else{
            $builder
                ->add('adherent', 'entity', array(
                                    'class' => 'AmbAdherentBundle:Adherent',
                                    'query_builder' => function(EntityRepository $er) {
                                        return $er->createQueryBuilder('a')
                                            ->orderBy('a.nom_prenom', 'ASC');
                                    },
                                    'property' => 'NomPrenom',
                                ))
                ->add('matricule', 'integer')
                ->add('dossier', 'choice', array(
                            'choices' => array('complet' => 'complet','incomplet' => 'incomplet')))
                ->add('type_immeuble', 'choice', array(
                            'choices' => $this->type_immeuble, /*'data' => 1*/))
                ->add('imm_group', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('immeuble', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('etage', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('appartement', 'text', array(
                            'required' => false,
                            'attr' => array('readonly' => 'readonly')))
                ->add('type_appartement', 'choice', array(
                            'choices' => $this->type_appartement, /*'data' => 1*/))
                ->add('surface_appt', 'integer')
                ->add('surface_terrace', 'integer', array('data' => 0))
                ->add('surface_jardin', 'integer', array( 'data' => 0))
                ->add('cout',  'money', array('precision' => 2, 'required' => true))
                ->add('type_echeance', 'choice', array(
                            'choices' => array('1' => 'MENSUEL',
                                               '3' => 'TRIMESTRIEL',
                                               '6' => 'SEMESTRIEL',
                                               '12' => 'ANNUEL')))
                ->add('nb_mois', 'integer', array('required' => false))
                ->add('date_debut', 'date', array('required' => false))
                ->add('echeance',  'money', array('precision' => 2, 'required' => false))
                ->add('avance',  'money', array('precision' => 2, 'required' => false))
                ->add('commentaire', 'textarea', array('required' => false))
                ->add('date_debutresrvation', 'date', array('required' => false))
                ->add('date_finresrvation', 'date', array('required' => false))
                ->add('piece_reservation', 'text', array('required' => false))
                ->add('montant_garantie',  'money', array('precision' => 2, 'required' => false))
                ;
        }
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Amb\AdherentBundle\Entity\Adhesion',
        ));
    }

    public function getName()
    {
        return 'amb_adherentbundle_adhesiontype';
    }
}
