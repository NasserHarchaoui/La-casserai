<?php

namespace App\Form;

use App\Entity\Reservering;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Reservering1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aankomstdatum')
            ->add('vertrekdatum')
            ->add('kinderen')
            ->add('volwassenen')
            ->add('dave')
            ->add('accountnummer')
            ->add('kamernummer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservering::class,
        ]);
    }
}
