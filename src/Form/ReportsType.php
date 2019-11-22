<?php

namespace App\Form;

use App\Entity\Report;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class,[
                'label' => 'Description',
                'attr' => array(
                    'placeholder' => 'Décrivez les raisons de votre signalement',
                    'maxlength' => 999
                    )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
        ]);
    }
}
