<?php

namespace App\Form;

use App\Entity\Filialas;
use App\Entity\Miestas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeistiFilialaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pavadinimas', EntityType::class, [
            'class' => Filialas::class,
            'label'=> 'Filialas',
            'choice_label' => 'pavadinimas',
            'attr' => [
            'class' => 'form-control'
            ]
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filialas::class,
        ]);
    }
}
