<?php

namespace App\Form;

use App\Entity\Horaire;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Jour', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Jour',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('ouverture', DateTimeImmutable::class, [

            ])
            ->add('fermture', DateTimeImmutable::class, [

            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'Enregistrer'
            ]);
    }
        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Horaire::class,
            ]);
        }
    }
