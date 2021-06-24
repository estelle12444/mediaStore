<?php

namespace App\Form;

use App\Entity\ArticleVoix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleVoixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class)
        ->add('description',TextareaType::class)
        ->add('prix', TextType::class)
        
        ->add('voixFile', FileType::class,[
            'label' => 'Entrer un audio (mp3, snd,mp4)',
            'mapped' => false,
            'required' => true,
            'constraints' => [
                new File([
                    'maxSize' => '13000k',
                    'mimeTypes' => [
                        'audio/mpeg',
                        'audio/basic',
                        'video/mp4'
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger  un audio valide (mp3, snd,mp4)',
                ])
            ],
        ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleVoix::class,
        ]);
    }
}
