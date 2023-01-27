<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ResetPasswordType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('oldPassword', PasswordType::class, [
        'label' => 'Ancien mot de passe',
        'label_attr' => [
          'class' => 'form-label mt-4 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ]
      ])
      ->add('newPassword', PasswordType::class, [
        'label' => 'Nouveau mot de passe',
        'label_attr' => [
          'class' => 'form-label mt-4 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ]
      ])
      ->add('confirmPassword', PasswordType::class, [
        'label' => 'Confirmer votre mot de passe',
        'label_attr' => [
          'class' => 'form-label mt-4 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ]
      ])
      ->add('submit', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-outline-primary mt-4',
        ],
        'label' => 'Valider',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      // Configure your form options here
    ]);
  }
}
