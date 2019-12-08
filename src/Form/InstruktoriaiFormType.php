<?php

namespace App\Form;

use App\Entity\Instruktorius;
use App\Entity\Filialas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstruktoriaiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vardas')
            ->add('pavarde')
            ->add('asmens_kodas')
            ->add('vairavimo_stazas_metais',  NumberType::class, [
                'invalid_message' => 'Vairavimo stažas nurodomas metais',
            ])
            ->add('telefono_numeris', NumberType::class, [
                'invalid_message' => 'Telefono numeris turi būti iš skaičių',
            ])
            ->add('gimimo_data', DateType::class, [
                'widget' => 'single_text',
                'invalid_message' => 'Asmens kodas turi būti iš skaičių',
            ])
            ->add('filialas', EntityType::class, [
                'class' => Filialas::class,
                'choice_label' => 'pavadinimas',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Instruktorius::class,
        ]);
    }
}
