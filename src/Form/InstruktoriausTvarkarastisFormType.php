<?php

namespace App\Form;

use App\Entity\InstruktoriausTvarkarastis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstruktoriausTvarkarastisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pradzia', DateTimeType::class, [
                'placeholder' => 'Select a value',
            ])
            ->add('pabaiga', DateTimeType::class, [
                'placeholder' => 'Select a value',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InstruktoriausTvarkarastis::class,
        ]);
    }
}
