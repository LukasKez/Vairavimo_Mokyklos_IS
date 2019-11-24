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

class FilialaiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pavadinimas')
            ->add('adresas')
            ->add('telefono_numeris', NumberType::class, [
                'invalid_message' => 'Telefono numeris turi būti iš skaičių',
            ])
            ->add('miestas', EntityType::class, [
                'class' => Miestas::class,
                'choice_label' => 'pavadinimas',
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
