<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
          // ->add('userAvatar', EntityType::class, [
          //   'class' => Image::class,
          //   'choice_label' => 'imageName',
          //   'label' => 'Photo profil',
          //   'label_attr' => [
      //     'class' => 'col-sm-2 col-form-label'
          //   ],
          //   'attr' => [
      //     'class' => 'form-select'
          //   ]
          // ])
          ->add('submit', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => [
              'class' => 'btn btn-outline-primary mt-3',
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
