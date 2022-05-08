<?php

namespace App\Form;

use App\Entity\Emission;
use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;


class EmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class, [
                'label' => "Titre"
            ])
            ->add('titreoriginal', TextType::class, [
                'label' => 'Titre Original'
            ])
            ->add('anneproduction',DateType::Class, [
                'years' => range(1960, date('Y')+10),
                'label' => 'Date Production'
            ])
            ->add('numsaison', IntegerType::class, [
                'label' => 'Numéro de Saison',
                'required' => false
            ])
            ->add('id_genre', EntityType::class, [
                'required' => true,
                'label' => 'Genre',
                'class' => Genre::class,
                'choice_label' => 'libelle',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une ville'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emission::class,
        ]);
    }
}
