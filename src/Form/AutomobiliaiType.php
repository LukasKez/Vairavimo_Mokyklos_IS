<?php

namespace App\Form;

use App\Entity\TransportoPriemone;
use App\Entity\Modelis;
use App\Entity\Marke;
use App\Entity\TransportoPriemonesBusena;
use App\Entity\PavaruDeze;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class AutomobiliaiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valstybiniai_nr', TextType::class, [
              'label'=>"Valstybiniai numeriai",
              'attr' => [
                'placeholder' => 'Įveskite valstybinius nr.',
                'class' => 'form-control'

              ]
            ])
            ->add('pagaminimo_metai', NumberType::class, [
                'label'=>"Pagaminimo metai",
                'invalid_message' => 'pagaminimo_metai turi būti nurodoma skaičiais',
                'attr' => [
                  'placeholder' => 'Įveskite pagaminimo metus',
                  'class' => 'form-control'
                ]
            ])
            ->add('busena', EntityType::class, [
                'label'=>"Automobilio būsena",
                'class' => TransportoPriemonesBusena::class,
                'choice_label' => 'pavadinimas',
                'attr' => [
                  'class' => 'form-control'
                ]
              ])
            ->add('pavaru_deze', EntityType::class, [
                'label'=>"Pavarų dėžė",
                'class' => PavaruDeze::class,
                'choice_label' => 'pavadinimas',
                'attr' => [
                  'class' => 'form-control'
                ]
              ])
            ->add('ilguma', NumberType::class, [
                'invalid_message' => 'koordinatės nurodomos skaičiais',
                'required' => false,
                'attr' => [
                  'placeholder' => 'Įveskite ilgumą (nebūtina)',
                  'class' => 'form-control'
                ]
              ])
              ->add('plokstuma', NumberType::class, [
                  'label'=>"Plokštuma",
                  'invalid_message' => 'koordinatės nurodomos skaičiais',
                  'required' => false,
                  'attr' => [
                    'placeholder' => 'Įveskite plokštumą (nebūtina)',
                    'class' => 'form-control'
                  ]
                ])
            ->add('kebulas', TextType::class, [
              'label'=>"Kėbulas",
              'attr' => [
                'placeholder' => 'Įveskite kėbulo tipą',
                'class' => 'form-control'
              ]
            ])
            ->add('kategorija', TextType::class, [
              'attr' => [
                'placeholder' => 'Įveskite kategoriją',
                'class' => 'form-control'
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TransportoPriemone::class,
        ]);
    }
}
