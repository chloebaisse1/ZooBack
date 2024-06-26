<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'3',
                    'maxlength'=>'255',
                ],
                'label'=>'Nom/ Prénom',
                'label_attr'=> [
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=> 3, 'max'=> 255])
                ]
            ])
            ->add('Pseudo', TextType::class, [
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'3',
                    'maxlength'=>'50',
                ],
                'required'=>false,
                'label'=>'Pseudo (Facultatif)',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],
                'constraints'=>[
                    new Assert\Length(['min'=> 3, 'max'=> 255])
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label'=> 'inscription',
                'attr'=> [
                    'class'=>'btn btn-primary mt-4'
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
