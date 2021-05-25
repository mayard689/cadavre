<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', null,['label' => "Objet"])
            ->add('text', null,['label' => "Corps du texte"])
            ->add('toMembers', null,['label' => "A destination des membres"])
            ->add('toProfessionals', null,['label' => "A destination des professionnels"])
            ->add('toPersons', null,['label' => "A destination des particuliers"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
