<?php

namespace App\Form;

use App\Entity\Categoriecsa;
use App\Entity\Diffusion;
use App\Entity\Programme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class DiffusionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lejour', DateType::class, [
                'label' => 'Date de Diffusion',
                'years' => range(2010, date('Y')+10)
            ])
            ->add('horaire', TimeType::class, [
                'label' => 'Heure de Diffusion'
            ])
            ->add('direct')
            ->add('id_programme', EntityType::class, [
                'required' => true,
                'label' => 'Titre du Programme',
                'class' => Programme::class,
                'choice_label' => 'titre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un programme'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diffusion::class,
        ]);
    }
}
