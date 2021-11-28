<?php

namespace App\Form;

use App\Entity\Devise;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('natureOperation', null, [
                'label' => "Nature opération",
                "attr"=> [
                    "rows" => "10"
                ]
                ])
            ->add('montant', null, [
                "label" => "Montant TTC",
                "html5" => true
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
            ->add('observations', TextareaType::class, [
                'label' => "Obsérvations",
                ])
            ->add('justifcatifFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Justifcatif'
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