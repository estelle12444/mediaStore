<?php

namespace App\Form;

use App\Entity\Personnalisation;

use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonnalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('email',EmailType::class)
            ->add('numero_whatsapp',NumberType::class)
            ->add('type_de_projet',ChoiceType::class, [
                'choices'  => [
                    'Image' => 'Image',
                    'Illustration' => 'Illustration',
                    'Video' => 'Video',
                    'VoixOff' => 'VoixOff',
                ],
                'label'=>'Quel est votre type de projet ?'
                ])
            ->add('Modele_photo',ChoiceType::class, [
                'choices'  => [
                    'Acteur' => 'Acteur',
                    'Mannequin' => 'Mannequin',

                ],
                'label'=>'Voulez-vous utiliser un modèle ?'
                ])
            ->add('messages',TextareaType::class,[
                'label'=>'Decrivez-nous votre projet'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnalisation::class,
        ]);
    }
}
