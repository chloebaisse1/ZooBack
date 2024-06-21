<?php

namespace App\Form;

use App\Entity\Horaire;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Jour', TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ],
                'label'=> 'Jour',
                'label_attr'=>[
                    'class'=> 'form-label mt-4'
                    ]
            ])
            ->add('Heure_debut', DateTimeType::class, [
                'attr'=>[
                    'class'=>'form-control',
                ],
                'label'=> 'Heure de début',
                'label_attr'=>[
                    'class'=> 'form-label mt-4'
                    ]
            ])
            ->add('Heure_fin', DateTimeType::class, [
                'attr'=>[
                    'class'=>'form-control',
                ],
                'label'=> 'Heure de fin',
                'label_attr'=>[
                    'class'=> 'form-label mt-4'
                    ]
            ])
            ->add('submit', SubmitType::class, [
                'attr'=>[
                    'class'=>'btn btn-primary mt-4'
                ],
                'label'=> 'Créer'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horaire::class,
        ]);
    }
}
