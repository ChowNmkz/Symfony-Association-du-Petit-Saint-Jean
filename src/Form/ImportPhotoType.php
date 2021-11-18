<?php

namespace App\Form;

use App\Entity\ImportPhoto;
use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\All;

class ImportPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date', DateType::class,  [
                'widget' => 'single_text',
            ])
            ->add('Title')
            ->add('path_photo', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'mimeTypes' => [
                                    'image/png',
                                    'image/jpeg',
                                    'image/png'
                                ],
                                'mimeTypesMessage' => 'Veuillez choisir un fichier dans le format attendu .png, .jpeg ou .jpg .',
                            ])
                            ],
                    ]),
                ],

            ])

            ->add('evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'name'
            ])
            ->add('Valider', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImportPhoto::class,
        ]);
    }
}
