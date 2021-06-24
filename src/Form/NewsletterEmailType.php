<?php

namespace App\Form;

use App\Entity\NewsletterEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null,['label' => "E-mail"])
            ->add('professional', null,['label' => "Le contact est il un professionnel ?"])
            ->add('member', null,['label' => "Le contact est il membre ?"])
            ->add('special', null,['label' => "Voulez vous marquer cet email comme 'special'"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsletterEmail::class,
        ]);
    }
}
