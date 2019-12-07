<?php

namespace App\Form;

use App\Entity\Instruktorius;
use App\Entity\Klientas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EgzaminoItraukimoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Klientas', EntityType::class, [
                'class' => Klientas::class,
                'choice_label' => 'getPilnasVardas',
            ])
            ->add('Instruktorius', EntityType::class, [
                'class' => Instruktorius::class,
                'choice_label' => 'getPilnasVardas',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
