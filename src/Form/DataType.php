<?php

namespace App\Form;

use App\Entity\DataUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

class DataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', FileType::class, [
                'required'   => false,
                'mapped'   => false,
                'multiple'   => false,
                'empty_data' => '',
                'label' => 'Photo de profil',
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
                        'maxRatio' => 2,
                        'maxRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en hauteur / largeur',
                        'minRatio' => 0.5,
                        'minRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en largeur / hauteur',
                        'minWidth' => 200,
                        'maxWidth' => 1200,
                        'minHeight' => 200,
                        'maxHeight' => 1200,
                        'maxWidthMessage' => 'La largeur maximum d\'une image est de {{ max_width }}px, la votre fait {{ width }}px',
                        'minWidthMessage' => 'La largeur minimum d\'une image est de {{ min_width }}px, la votre fait {{ width }}px',
                        'maxHeightMessage' => 'La hauteur maximum d\'une image est de {{ max_height }}px, la votre fait {{ height }}px',
                        'minHeightMessage' => 'La hauteur minimum d\'une image est de {{ min_height }}px, la votre fait {{ height }}px',
                    ]),
                ])]
            ])
            // ->add('bgLink', FileType::class, [
            //     'required'   => false,
            //     'mapped'   => false,
            //     'multiple'   => false,
            //     'empty_data' => '',
            //     'label' => 'Background',
            //     'constraints' => [new Assert\All([
            //         new Assert\File([ 
            //             'mimeTypes' => [
            //                 'image/png',
            //                 'image/jpg',
            //                 'image/jpeg',
            //                 ],
            //             'mimeTypesMessage' => 'Seulement les images .jpg, .jpeg ou .png',
            //             ]),
            //         new Assert\Image([ 
            //             // 'maxRatio' => 2,
            //             // 'maxRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en hauteur / largeur',
            //             // 'minRatio' => 0.5,
            //             'minRatioMessage' => 'Votre image ne peut pas être deux fois plus grande en largeur / hauteur',
            //             'minWidth' => 800,
            //             'maxWidth' => 3000,
            //             'minHeight' => 800,
            //             'maxHeight' => 3000,
            //             'maxWidthMessage' => 'La largeur maximum d\'une image est de {{ max_width }}px, la votre fait {{ width }}px',
            //             'minWidthMessage' => 'La largeur minimum d\'une image est de {{ min_width }}px, la votre fait {{ width }}px',
            //             'maxHeightMessage' => 'La hauteur maximum d\'une image est de {{ max_height }}px, la votre fait {{ height }}px',
            //             'minHeightMessage' => 'La hauteur minimum d\'une image est de {{ min_height }}px, la votre fait {{ height }}px',
            //         ]),
            //     ])]
            // ])
            ->add('facebook', TextType::class, array(
                'required'   => false,
                'empty_data' => '',
                'label' => 'Nom de compte Facebook',
                'attr' => array(
                    // 'class' => 'formType',
                    'placeholder' => 'exemple',
                    'maxlength' => 255
                    )
            ))
            ->add('twitter', TextType::class, array(
                'required'   => false,
                'empty_data' => '',
                'label' => 'Nom de compte Twitter',
                'attr' => array(
                    // 'class' => 'formType',
                    'placeholder' => 'exemple',
                    'maxlength' => 255
                    )
            ))
            ->add('instagram', TextType::class, array(
                'required'   => false,
                'empty_data' => '',
                'label' => 'Nom de compte Instagram',
                'attr' => array(
                    // 'class' => 'formType',
                    'placeholder' => 'exemple',
                    'maxlength' => 255
                    )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DataUser::class,
        ]);
    }
}
