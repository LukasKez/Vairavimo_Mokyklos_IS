<?php

namespace App\Form;

use App\Entity\Egzaminas;
use App\Entity\Naudotojas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriminimoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Kam')



            ->add('EgzaminoDuomenys', EntityType::class, [
                'class' => Egzaminas::class,
                'choice_label' => 'getPavadinimas',
            ])
            ->add('Komentarai', TextareaType::class, [
                'required' => false
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