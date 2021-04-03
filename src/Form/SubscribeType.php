<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class SubscribeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,['label' => "Votre nom"])
            ->add('email', EmailType::class,['label' => "Votre courriel"])
            ->add('phone',null,[
                'label' => "Votre numéro de téléphone",
                'constraints' => [
                    new Regex([
                        'pattern' => "/^(0|\\+33|0033) ?[1-9] ?[0-9]{2} ?[0-9]{2} ?[0-9]{2} ?[0-9]{2}$/",
                        'message' => "Un code postal doit par 0, +33 ou 0033 suivi de 9 chiffres avec eventuellement un espace entre chaque série de 2 chiffres."
                    ]),
                ]
            ])
            ->add('street',null,['label' => "Votre rue"])
            ->add('zipcode',null,[
                'label' => "Votre code postal",
                'data' =>'45170',
                'constraints' => [
                    new Regex([
                        'pattern' => "/^((0[1-9])|([1-8][0-9])|(9[0-8]))[ ]{0,1}[0-9]{3}$/",
                        'message' => "Un code postal doit contenir 5 chiffres avec eventuellement un espace entre les deux premiers et les trois derniers chiffres."
                    ]),
                ]
            ])
            ->add('city',null,[
                'label' => "Votre ville",
                'data' =>'Villereau'
            ])
            ->add('message', TextareaType::class,[
                'label' => "Votre message ou suggestion",
                'required'=>false
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
