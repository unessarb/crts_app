<?php

namespace App\Form;

use App\Entity\Depense;
use App\Entity\Personnel;
use App\Entity\NatureOperationDepense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', null, [
                "label" => "Référence",
                ])
                ->add('typeDpense', EntityType::class, [
                    // looks for choices from this entity
                    'class' => NatureOperationDepense::class,
                    "placeholder" => "Selectionner la Rubrique",
                    'choice_label' => "natureOperation",
                    'label' => "Rubrique",
                    "attr"=> [
                        "class" => "select2bs4"
                    ]
                    ])
            ->add('objet', null, [
                "label" => "Objet",
                ])
            ->add('obs', null, [
                "label" => "Observations",
                ])
            ->add('montant')
            ->add('documentPassationFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Ordre de paiement'
            ])
            ->add('documentExecutionFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Facture'
            ])
            ->add('documentOrdreFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Ordre de mission'
            ])
            ->add('beneficiaire', EntityType::class, [
                // looks for choices from this entity
                'class' => Personnel::class,
                "placeholder" => "Selectionner le beneficiaire",
                'choice_label' => "name",
                'label' => "Bénéficiaire",
                "attr"=> [
                    "class" => "select2bs4"
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}