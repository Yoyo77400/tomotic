<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isDefault', CheckboxType::class, ["required"=>false, "label"=>"Adresse par défault", "attr"=>["class"=>"form-check-input"], "row_attr"=>["class"=>"form-switch"]])
            ->add('nom', TextType::class, ['required'=> true])
            ->add('rue', TextType::class, ['required'=> true])
            ->add('complement', TextType::class, ['required'=> false])
            ->add('ville', TextType::class, ['required'=> true])
            ->add('codePostal', NumberType::class, ['required'=> true])
            ->add('pays', CountryType::class, ['required'=>true])
            ->remove('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
            'fromUser' => false
        ]);
    }
}
