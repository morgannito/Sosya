<?php

namespace App\Form;

use App\Entity\Sexe;
use App\Entity\Civility;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CivilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom *',
                'attr' => array(
                    // 'class' => 'formType',
                    'placeholder' => 'Votre nom',
                    'maxlength' => 47
                    )
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'Prénom *',
                'attr' => array(
                    'placeholder' => 'Votre prénom',
                    'maxlength' => 102
                    )
            ))
            ->add('birth', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de Naissance *'
            ])
            ->add('description', TextareaType::class, [
                'required'   => false,
                'empty_data' => '',
                'label' => 'Description',
                'attr' => array(
                    'placeholder' => 'Faites vous une description.',
                    'maxlength' => 999
                    )
            ])
            ->add('sexe', EntityType::class, [
                // looks for choices from this entity
                'class' => Sexe::class,
                // uses the Sexe.name property as the visible option string
                'choice_label' => 'name',
                'label' => 'Sexe *'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Civility::class,
        ]);
    }
}
