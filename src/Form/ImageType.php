<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('imageFile', VichImageType::class, [
            'imagine_pattern' => 'profile',
            'label' => 'Photo',
            'download_uri' => false,
            'required' => false,
            'label_attr' => [
              'class' => '',
            ],
            'attr' => [
              'class' => 'btn btn-primary btn-sm mt-1 mb-1',
            ],
          ])
          ->add('user', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'email',
            'label' => 'Choisir un utilisateur',
            'label_attr' => [
              'class' => 'col-sm-2 col-form-label',
            ],
            'attr' => [
              'class' => 'form-select',
            ],
          ])
          ->add('submit', SubmitType::class, [
            'label' => 'Sauvegarder',
            'attr' => [
              'class' => 'btn btn-primary mt-3',
            ],
          ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
          'data_class' => Image::class,
        ]);
    }
}
