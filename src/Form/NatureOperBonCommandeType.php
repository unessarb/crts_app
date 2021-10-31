<?php

namespace App\Form;

use App\Entity\NatureOperationBonCommande;
use App\Entity\Tfs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NatureOperBonCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('tfs', EntityType::class, [
                // looks for choices from this entity
                'class' => Tfs::class,
                'choice_label' => function (Tfs $tfs) {
                    return $tfs->getCode() . ' | ' . $tfs->getName();
            
                    // or better, move this logic to Customer, and return:
                    // return $customer->getFullname();
                },
                'label' => "TFS"
            ])
            ->add('natureOperation', null, [ "label" => "Nature opération" ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NatureOperationBonCommande::class,
        ]);
    }
}