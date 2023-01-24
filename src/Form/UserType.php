<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('firstName', TextType::class, [
        'label' => 'Prénom',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control col-md-8 col-lg-9',
        ],
      ])
      ->add('lastName', TextType::class, [
        'label' => 'Nom',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ],
      ])
      ->add('address', TextType::class, [
        'label' => 'Adresse',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control col-md-8 col-lg-9',
        ],
      ])
      ->add('zipCode', TextType::class, [
        'label' => 'Code postal',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ],
      ])
      ->add('email', EmailType::class, [
        'label' => 'Email',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ],
      ])
      ->add('phone', TextType::class, [
        'label' => 'Téléphone',
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'form-control',
        ],
      ])
      ->add('imageFile', VichImageType::class, [
        'label' => 'Photo',
        'download_uri' => false,
        'required' => false,
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label',
        ],
        'attr' => [
          'class' => 'mt-3 mb-3',
          'style' => 'width:250px;',
        ],
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
        'attr' => [
          'class' => 'btn btn-primary mt-3',
        ],
      ]);
  }
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
