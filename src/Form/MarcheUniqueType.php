<?php

namespace App\Form;

use App\Entity\Devise;
use App\Entity\MarcheUnique;
use App\Entity\NatureOperationMarcheUnique;
use App\Entity\Societe;
use App\Entity\SocieteTitulaire;
use App\Entity\Tfs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MarcheUniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numMarche', null, [
                "label" => "N° Marché"
                ])
            ->add('tfs', EntityType::class, [
                // looks for choices from this entity
                'class' => Tfs::class,
                "placeholder" => "Selectionner le TFS",
                'choice_label' => function (Tfs $tfs) {
                    return $tfs->getCode() . ' | ' . $tfs->getName();
            
                    // or better, move this logic to Customer, and return:
                    // return $customer->getFullname();
                },
                'label' => "TFS",
                "attr"=> [
                    "class" => "select2bs4"
                ]
            ])
            ->add('typeMarche', ChoiceType::class, [
                'choices'  => [
                    '0 | Unique' => 0,
                    '1 | Cadre' => 1,
                ],
                "placeholder" => "Selectionner le type du marché",
                "label" => "Type Marché"
                ])
            ->add('modePassassion', ChoiceType::class, [
                'choices'  => [
                    '0 | Ouvert' => 0,
                    '1 | Négocié' => 1,
                    '2 | Restreint' => 2
                ],
                "placeholder" => "Selectionner le mode de passassion",
                "label" => "Mode passassion"
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
                    "class" => "select2bs4",
                    "id"=> "societe"
                ]
                ])
            ->add('natureOperation', EntityType::class, [
                // looks for choices from this entity
                'class' => NatureOperationMarcheUnique::class,
                'choice_label' => "natureOperation",
                "placeholder" => "Selectionner la nature opération",
                'label' => "Nature opération",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
            ->add('lineBudgetaire', null, [
                "label" => "Ligne Budgétaire"
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
                "label" => "Annee budgétaire"
                ])
            ->add('montant', null, [
                "label" => "Montant TTC"
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
            ->add('documentPassationFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Document Passation'
            ])
            ->add('documentExecutionFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Document Execution'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MarcheUnique::class,
        ]);
    }
}