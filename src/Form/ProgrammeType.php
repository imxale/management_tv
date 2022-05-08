<?php

namespace App\Form;

use App\Entity\Categoriecsa;
use App\Entity\Emission;
use App\Entity\Programme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée (min)'
            ])
            ->add('id_emission', EntityType::class, [
                'required' => true,
                'label' => 'Emission',
                'class' => Emission::class,
                'choice_label' => 'titreoriginal',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une emission'
                    ])
                ]
            ])
            ->add('id_categoriecsa', EntityType::class, [
                'required' => true,
                'label' => 'Categorie CSA',
                'class' => Categoriecsa::class,
                'choice_label' => 'libelle',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une categorie CSA'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
