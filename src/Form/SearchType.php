<?php

namespace App\Form;

use App\Model\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('q', TextType::class, [
            'attr' => [
              'class' => 'search-form d-flex align-items-center',
              'placeholder' => 'Taper votre recherche',
            ],
          ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
          'data_class' => SearchData::class,
          'method' => 'GET',
          'csrf_protection' => false,
        ]);
    }
}
