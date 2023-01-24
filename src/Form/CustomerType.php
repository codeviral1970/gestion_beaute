<?php

namespace App\Form;

use App\Entity\Soin;
use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CustomerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('firstName', TextType::class, [
        'label' => 'Prénom',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-5',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('lastName', TextType::class, [
        'label' => 'Nom',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('address', TextType::class, [
        'label' => 'Adresse',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('zipCode', TextType::class, [
        'label' => 'Code postal',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('email', EmailType::class, [
        'label' => 'Email',
        'label_attr' => [
          'class' => 'col-lg-9 col-md-8',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('phone', TelType::class, [
        'label' => 'Téléphone',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ],
      ])
      ->add('imageFile', VichImageType::class, [
        'label' => 'Photo',
        'download_uri' => false,
        'required' => false
      ])
      ->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
        'attr' => [
          'class' => 'btn btn-success mt-4',
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Customers::class,
    ]);
  }
}
