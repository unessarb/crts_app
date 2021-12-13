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
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
                ->add('dateDepense', DateType::class, [
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                    
                        // prevents rendering it as type="date", to avoid HTML5 date pickers
                        'html5' => false,
                    
                        // adds a class that can be selected in JavaScript
                        'attr' => ['class' => 'js-datepicker'],
                    ])
            ->add('objet', null, [
                "label" => "Objet",
                ])
            ->add('obs', null, [
                "label" => "Observations",
                ])
                ->add('montant', null, [
                    "label" => "Montant TTC (MAD)"
                    ])
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