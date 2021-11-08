<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraints = [
            new Length([
                'min' => 6,
                'minMessage' => 'Votre mot de passe doit être au moins {{ limit }} caractères',
                // max length allowed by Symfony for security reasons
                'max' => 4096,
            ])
            ];
        if($options['default-from'] === "new"){
            array_push($constraints, new NotBlank([
                'message' => 'Veuillez entrer un mot de passe',
            ]));
        }
        $builder
            ->add('firstName', null, [
                'label' => 'Prénom'
            ])
            ->add('lastName', null, [
                'label' => 'Nom'
            ])
            ->add('email')
            ->add('phone', null, [
                'label' => 'Téléphone'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => $constraints,
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de passe',
                ],
                'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'default-from' => 'new'
        ]);
    }
}