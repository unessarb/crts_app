<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Devise;
use App\Entity\LigneBudgetaire;
use App\Entity\NatureOperationContrat;
use App\Entity\Societe;
use App\Entity\SocieteTitulaire;
use App\Entity\Tfs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numCC', null, [
                "label" => "N° C-C",
                ])
            ->add('typeContrat', ChoiceType::class, [
                'choices'  => [
                    '0 | Contrat' => 0,
                    '1 | Contrat de droit commun' => 1,
                ],
                "placeholder" => "Selectionner le type contrat",
                "label" => "Type contrat"
                ])
            ->add('titulaire', EntityType::class, [
                // looks for choices from this entity
                'class' => SocieteTitulaire::class,
                'choice_label' => "name",
                "placeholder" => "Selectionner titulaire de la société",
                'label' => "Titulaire de la société",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
            ->add('societe', EntityType::class, [
                // looks for choices from this entity
                'class' => Societe::class,
                "placeholder" => "Selectionner le nom de la société",
                'choice_label' => "name",
                'label' => "Nom de la société",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
            ->add('natureOperation', EntityType::class, [
                // looks for choices from this entity
                'class' => NatureOperationContrat::class,
                'choice_label' => "natureOperation",
                "placeholder" => "Selectionner la nature opération",
                'label' => "Nature opération",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
            ->add('lineBudgetaire', EntityType::class, [
                // looks for choices from this entity
                'class' => LigneBudgetaire::class,
                'choice_label' => "rubrique",
                "placeholder" => "Selectionner la ligne budgétaire",
                'label' => "Ligne budgétaire",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
            ->add('fontionnementInvestissement', ChoiceType::class, [
                'choices'  => [
                    'F' => "F",
                    'I' => "I",
                ],
                "placeholder" => "Selectionner F / I",
                "label" => "Fonctionnement (F) Investissement (I)"
                ])
            ->add('anneeBudgetaire', null, [
                "label" => "Annee budgétaire",
                ])
            ->add('montant', null, [
                "label" => "Montant TTC",
                ])
            ->add('devise', EntityType::class, [
                // looks for choices from this entity
                'class' => Devise::class,
                'choice_label' => "name",
                "placeholder" => "Selectionner le devise",
                'label' => "Devise",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])

                ->add('demandeDevisFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Demande de devis x 3'
                ])
                ->add('lettreSntlFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Letrre SNTL'
                ])
                ->add('contratSigneFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => "Contrat signé, paraphé"
                ])
                ->add('conventionSigneFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Convention signé'
                ])
                ->add('devisContradictoireFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Devis contradictoires x 3'
                ])

                ->add('contratSignePaiementFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Contrat signé, visé et approuvé'
                ])

                ->add('bonLivraisonFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Bon de livraison'
                ])
                ->add('factureFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Facture'
                ])
                ->add('bordereauFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => "Bordereau d’émission"
                ])
                ->add('ordonnancementFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Ordonnancement'
                ])
                ->add('avisVirementFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Avis de virement'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}