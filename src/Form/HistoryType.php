<?php

namespace App\Form;

use App\Entity\History;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HistoryType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('service', TextType::class, [
        'label' => 'Soin donnée',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ]
      ])
      ->add('content', TextareaType::class, [
        'label' => 'Description des soins',
        'label_attr' => [
          'class' => 'col-md-8 col-lg-9',
        ],
        'attr' => [
          'class' => 'col-lg-9 col-md-8 form-control mb-2',
        ]
      ])
      // ->add('image', FileType::class, [
      //   'label' => 'Ajouter des photos',
      //   'label_attr' => [
      //     'class' => 'col-md-8 col-lg-9',
      //   ],
      //   'required' => false
      // ])
      ->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
        'attr' => [
          'class' => 'btn btn-primary mt-3'
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => History::class,
    ]);
  }
}
