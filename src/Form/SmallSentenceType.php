<?php

namespace App\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class SmallSentenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextareaType::class, ['label' =>'Texte'])
            ->add('pseudo', null, [
                'label' =>'Votre pseudonyme (facultatif)',
                'required' => false,
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Votre pseudo doit faire moins de 254 caractères',
                    ]),
                ]
            ])
            ->add('previous', HiddenType::class, [
                'label' =>'previousSecret',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
