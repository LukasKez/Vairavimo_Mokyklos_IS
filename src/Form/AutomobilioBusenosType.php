<?php

namespace App\Form;

use App\Entity\TransportoPriemonesBusena;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\ChoiceType;

class AutomobilioBusenosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pavadinimas', EntityType::class, [
                'class' => TransportoPriemonesBusena::class,
                'mapped'=> false,
                'label'=>"Pasirinkite būseną: ",
                'invalid_message' => 'Klaida: pasirinkta būsena neegzistuoja',
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
            'data_class' => TransportoPriemonesBusena::class,
        ]);
    }
}
