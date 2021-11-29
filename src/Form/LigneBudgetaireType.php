<?php

namespace App\Form;

use App\Entity\LigneBudgetaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LigneBudgetaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num', null, [
                "label" => "Numèro de la ligne budgétaire"
                ])
            ->add('fontionnementInvestissement', ChoiceType::class, [
                'choices'  => [
                    'F' => "F",
                    'I' => "I",
                ],
                "placeholder" => "Selectionner F / I",
                "label" => "Fonctionnement (F) Investissement (I)"
                ])
            ->add('rubrique', null, [ "label" => "Rubrique" ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneBudgetaire::class,
        ]);
    }
}