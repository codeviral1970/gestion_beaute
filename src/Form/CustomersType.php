<?php

namespace App\Form;

use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CustomersType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('firstName', TextType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'col-md-4 col-lg-3 col-form-label'
        ],
        'attr' => [
          'class' => 'form-control col-md-8 col-lg-9'
        ],
      ])
      ->add('lastName',  TextType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'CUSTOM_LABEL_CLASS'
        ],
        'attr' => [
          'class' => 'form-control'
        ],
      ])
      ->add('address',  TextType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'CUSTOM_LABEL_CLASS'
        ],
        'attr' => [
          'class' => 'form-control'
        ],
      ])
      ->add('zipCode',  TextType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'CUSTOM_LABEL_CLASS'
        ],
        'attr' => [
          'class' => 'form-control'
        ],
      ])
      ->add('email',  EmailType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'CUSTOM_LABEL_CLASS'
        ],
        'attr' => [
          'class' => 'form-control'
        ],
      ])
      ->add('phone',  TelType::class, [
        'label' => false,
        'label_attr' => [
          'class' => 'CUSTOM_LABEL_CLASS'
        ],
        'attr' => [
          'class' => 'form-control'
        ],
      ])
      ->add('imageFile',VichImageType::class, [
        'label' => 'Photo',
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Mettre à jour',
        'attr' => [
          'class' => 'btn btn-primary'
        ]
      ])
      ;

  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Customers::class,
    ]);
  }
}
