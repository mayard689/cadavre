<?php

namespace App\Form;

use App\Entity\NewsletterEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterSubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                    'label' => 'email',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'votre-email@mail.fr'
                    ]
                ]
            )
            ->add('professional', null,['label' => "Je vous suis pour des raisons professionnelles"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsletterEmail::class,
        ]);
    }
}
