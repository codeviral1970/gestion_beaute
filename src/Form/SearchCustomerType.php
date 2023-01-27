<?php

namespace App\Form;

use App\Entity\SearchCustomer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchCustomerType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('nom', TextType::class, [
        'label' => false,
        'attr' => [
          'placeholder' => 'Taper votre recherche',
        ]
      ]);
    // ->add('lastName', TextType::class, [
    //   'attr' => [
    //     'placeholder' => 'Taper votre recherche',
    //   ]
    // ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => SearchCustomer::class,
      'method' => 'GET',
      'csrf_protection' => false,
    ]);
  }
}
