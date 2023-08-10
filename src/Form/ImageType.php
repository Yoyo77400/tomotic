<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('updatedAt')
            ->remove('imageName')
            ->add('description', TextType::class, ["required"=>false])
            ->add('rankOrder', NumberType::class, ["required"=>true, "attr"=>["min"=>1]])
            ->add('imageFile', FileType::class, ["required"=>true, "label"=>"Image", "attr"=>['class'=>'select-image']])
        ;
        if(!$options["fromProduit"]){
            $builder
            ->add('produit', EntityType::class, ['class'=>Produit::class, "choice_label"=>"nom","required"=>true])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            'fromProduit'=> false,
        ]);
    }
}
