<?php

namespace App\Form;

use App\Entity\CommentContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, array(
                'label' => 'Commenter',
                'attr' => array(
                    'placeholder' => 'Commentaire',
                    'maxlength' => 999
                    )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentContent::class,
        ]);
    }
}
