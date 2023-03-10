<?php

namespace App\Form;

use App\Dto\CarDto;
use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class CreateCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carBrand', TextType::class, [
                'label' => 'Brand'
            ])
            ->add('carModel', TextType::class, [
                'label' => 'Model'
                ]
            )
            ->add('regNumber', TextType::class, [
                'label' => 'Registration number'
            ])
            ->add('vin', TextType::class,[
                'label' => 'VIN'
            ])
            ->add('prodYear', IntegerType::class, [
                'label' => 'Production year',
                'attr' => [
                    'placeholder' => 'example 2010'
                ]
            ])
            ->add('typeOfFuel', ChoiceType::class, [
                'label' => 'Fuel',
                'choices' => Car::FUEL_TYPE_MAP
            ])
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacity ccm',
                'attr' => [
                    'placeholder' => 'example 1800'
                ]
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarDto::class,
        ]);
    }
}