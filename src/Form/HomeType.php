<?php

namespace App\Form;

use App\Entity\Home;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive', CheckboxType::class, ['required'=>false, 'label'=> "Active", "attr"=>['class'=>'form-check-imput'],'row_attr' => ['class' => 'form-switch mb-2 mt-3']])
            ->add('titre', TextType::class, ['required'=>true])
            ->add('texte', TextareaType::class, ['required'=>true])
            ->remove('updatedAt')
            ->remove('imageName')
            ->add('imageFile', FileType::class, ["required"=>false, "label"=>"Image","attr"=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
