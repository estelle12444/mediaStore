<?php

namespace App\Form;

use App\Entity\ArticleVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ArticleVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('titre')
            ->add('description')
            ->add('prix')
            ->add('videoFile',FileType::class,[
                'label' => 'Entrer une image (mp4, avi ,movie)',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '44000k',
                        'mimeTypes' => [
                            'video/mp4',
                            'video/x-msvideo',
                            'video/x-sgi-movie',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une video valide (mp4, avi ,movie)',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleVideo::class,
        ]);
    }
}
