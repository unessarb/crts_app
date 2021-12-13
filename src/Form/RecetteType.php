<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\NatureRecette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('numCC', null, [
            "label" => "N° des quittances à souches"
            ])
            ->add('partieversantes', null, [ "label" => "Nom de la partie versante" ])
            ->add('dateRecette', DateType::class, [
    'widget' => 'single_text',
    'format' => 'yyyy-MM-dd',

    // prevents rendering it as type="date", to avoid HTML5 date pickers
    'html5' => false,

    // adds a class that can be selected in JavaScript
    'attr' => ['class' => 'js-datepicker'],
])
->add('typeRecette', ChoiceType::class, [
    'choices'  => [
        'Recette Directe' => 'Recette Directe',
        'Recette via GID' => 'Recette via GID'
    ],
    "label" => "Type de la recette"
    ])
            ->add('obs', null, [ "label" => "Observations" ])
            ->add('montant', null, [
                "label" => "Montant TTC (MAD)"
                ])
                ->add('documentPassationFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Facture'
                ])
                ->add('documentExecutionFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Devis'
                ])
                ->add('documentAutreFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Convention, Contrat, etc.'
                ])
                ->add('documentBonFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Bon de commande'
                ])
                ->add('documentNotifFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Notification'
                ])
                ->add('documentOrdreFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Ordre de recette de régularisation'
                ])
            ->add('natureRecette', EntityType::class, [
                // looks for choices from this entity
                'class' => NatureRecette::class,
                "placeholder" => "Selectionner la nature de la recette",
                'choice_label' => "natureOperation",
                'label' => "Nature de la recette",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}