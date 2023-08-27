<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Contenu;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('updatedAt')
            ->remove('imageName')
            ->add('description', TextType::class, ["required"=>false])
            ->add('rankOrder', NumberType::class, ["required"=>true, "attr"=>["min"=>1]])
            ->add('imageFile', FileType::class, ["required"=>$options['isNew'], "label"=>"Image", "attr"=>['class'=>'select-image']])
            ->add('produit', EntityType::class, ['class'=>Produit::class, "choice_label"=>"nom", 'required'=>false])
            ->add('contenu', EntityType::class, ['required'=>false, 'class'=>Contenu::class, 'choice_label'=>'titre'])
        ;
        if($options["fromProduit"] === true){
            $builder
            ->remove('produit')
            ->remove('contenu')
            ;
        }
        if($options["fromContenu"] === true){
            $builder
            ->remove('produit')
            ->remove('contenu')
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            'fromProduit'=> false,
            'fromContenu'=> false,
            'isNew' => true,
        ]);
    }
}
