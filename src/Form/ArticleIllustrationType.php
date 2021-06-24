<?php

namespace App\Form;

use App\Entity\ArticleIllustration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleIllustrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class)
        ->add('description',TextareaType::class)
        ->add('prix', TextType::class)
        
        ->add('illustrationFile', FileType::class,[
            'label' => 'Entrer une illustration (svg, PNG, JPEG, tif)',
            'mapped' => false,
            'required' => true,
            'constraints' => [
                new File([
                    'maxSize' => '8000k',
                    'mimeTypes' => [
                        'image/svg+xml',
                        'image/png',
                        'image/jpeg',
                        'image/tiff'
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger une illustration valide (svg, PNG, JPEG, tif)',
                ])
            ],
        ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleIllustration::class,
        ]);
    }
}
