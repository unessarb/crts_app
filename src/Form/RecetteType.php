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

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('numCC', null, [
            "label" => "N° des quittances à souches"
            ])
            ->add('partieversantes', null, [ "label" => "Nom de la partie versante" ])
            ->add('obs', null, [ "label" => "Observations" ])
            ->add('montant', null, [
                "label" => "Montant TTC"
                ])
                ->add('documentPassationFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Justificatif 1'
                ])
                ->add('documentExecutionFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Supprimer',
                    'download_label' => 'Télécharger',
                    'asset_helper' => true,
                    'label' => 'Justificatif 2'
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
