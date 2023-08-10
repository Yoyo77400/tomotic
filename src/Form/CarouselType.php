<?php

namespace App\Form;

use App\Entity\Carousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('updatedAt')
            ->remove('imageName')
            ->add('isActive', CheckboxType::class, ["required"=>false, "label"=>"Active", "attr"=>["class"=>"form-check-input"], "row_attr"=>["class"=>"form-switch"]])
            ->add('titre', TextType::class, ["required"=>false])
            ->add('description', TextType::class, ["required"=>false])
            ->add('tag', TextType::class, ["required"=>true, "label"=>"Tag", "row_attr"=>["class"=> "mb-0"]])
            ->add('rankNumber', NumberType::class, ["required"=>true, "label"=>"Ordre", "row_attr"=>["class"=> "mb-0"]])
            ->add('imageFile', FileType::class, ["required"=>true, "label"=>"Image"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carousel::class,
        ]);
    }
}
