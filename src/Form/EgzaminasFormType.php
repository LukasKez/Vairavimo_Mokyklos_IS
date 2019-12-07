<?php

namespace App\Form;

use App\Entity\Egzaminas;
use App\Entity\EgzaminuTipai;
use Cassandra\Date;
use Cassandra\Time;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EgzaminasFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('EgzaminoTipas', EntityType::class, [
                'class' => EgzaminuTipai::class,
                'choice_label' => 'name',
            ])
            ->add('data')
            ->add('laikas')
            ->add('adresas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Egzaminas::class,
        ]);
    }
}
