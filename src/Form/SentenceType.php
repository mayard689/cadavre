<?php

namespace App\Form;

use App\Entity\Chapter;
use App\Entity\Sentence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SentenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', null, ['label' =>'Texte'])
            ->add('previous', EntityType::class, [
                'class' => Sentence::class,
                'choice_label' => 'id',
                'multiple'=>false,
                'expanded'=>false,
                'label' =>'Numero de la phrase précédente'
            ])
            ->add('chapter', EntityType::class, [
                'class' => Chapter::class,
                'choice_label' => 'title',
                'multiple'=>false,
                'expanded'=>false,
                'label' => 'Ma contribution au chapitre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sentence::class,
        ]);
    }
}
