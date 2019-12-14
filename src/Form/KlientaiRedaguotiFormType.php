<?php

namespace App\Form;

use App\Entity\Naudotojas;
use App\Entity\Klientas;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class KlientaiRedaguotiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('asmens_kodas', NumberType::class, [
                'invalid_message' => 'Asmens kodas turi būti iš skaičių',
            ])
            ->add('vardas')
            ->add('pavarde', TextType::class, [
                'label' => 'Pavardė'
            ])

            ->add('gimimo_metai', DateType::class, [
                'widget' => 'single_text',
                'invalid_message' => 'Asmens kodas turi būti iš skaičių',
            ])
            ->add('telefono_numeris', NumberType::class, [
                'invalid_message' => 'Telefono numeris turi būti iš skaičių',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Klientas::class,
        ]);
    }
}