<?php

namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'required'   => false,
                'empty_data' => '',
                'label' => 'Titre',
                'attr' => array(
                    // 'class' => 'TextType',
                    'placeholder' => 'Votre titre',
                    'maxlength' => 255
                )
            ])
            ->add('text', TextareaType::class,[
                'required'   => false,
                'empty_data' => '',
                'label' => 'Description',
                'attr' => array(
                    'placeholder' => 'Mettez une description à votre publication',
                    'maxlength' => 999
                    )
            ])
            ->add('my_files', FileType::class, [
                'required'   => false,
                'mapped'   => false,
                'multiple'   => true,
                'empty_data' => '',
                'label' => 'Ajouter une/des image(s)',
                'constraints' => [new Assert\All([
                    new Assert\File([ 
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                            ],
                        'mimeTypesMessage' => 'Seulement les images .jpg, .jpeg ou .png',
                        ]),
                    new Assert\Image([ 
                        'maxRatio' => 3,
                        'maxRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en hauteur / largeur',
                        'minRatio' => 0.25,
                        'minRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en largeur / hauteur',
                        'minWidth' => 100,
                        'maxWidth' => 1500,
                        'minHeight' => 100,
                        'maxHeight' => 1500,
                        'maxWidthMessage' => 'La largeur maximum d\'une image est de {{ max_width }}px, la votre fait {{ width }}px',
                        'minWidthMessage' => 'La largeur minimum d\'une image est de {{ min_width }}px, la votre fait {{ width }}px',
                        'maxHeightMessage' => 'La hauteur maximum d\'une image est de {{ max_height }}px, la votre fait {{ height }}px',
                        'minHeightMessage' => 'La hauteur minimum d\'une image est de {{ min_height }}px, la votre fait {{ height }}px',
                    ]),
                ])]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
