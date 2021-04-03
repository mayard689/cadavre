<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label' => "Votre nom"])
            ->add('phone',null,['label' => "Votre numéro de téléphone"])
            ->add('street',null,['label' => "Votre rue"])
            ->add('zipcode',null,['label' => "Votre code postal", 'data' =>'45170'])
            ->add('city',null,['label' => "Votre ville", 'data' =>'Villereau'])
            ->add('email', EmailType::class,['label' => "Votre courriel"])
            ->add('message', TextareaType::class,['label' => "Si vous avez une suggestion, c'est le moment !"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
