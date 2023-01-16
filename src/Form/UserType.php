<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',  EmailType::class, [
            'label' => 'Email',
            'label_attr' => [
              'class' => 'CUSTOM_LABEL_CLASS'
            ],
            'attr' => [
              'class' => 'form-control'
            ],
        ])
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'label_attr' => [
                'class' => 'col-md-4 col-lg-3 col-form-label'
            ],
            'attr' => [
                'class' => 'form-control col-md-8 col-lg-9'
            ],
        ])
            ->add('lastName',  TextType::class, [
            'label' => 'Nom',
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
            'label' => 'Enregistrer',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
