<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Form\ProduitType;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SousCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('slug')
            ->remove('imageName')
            ->remove('updatedAt')
            ->add('isActive', CheckboxType::class, ["required"=>false, "label"=>"Active", "attr"=>["class"=>"form-check-input"], "row_attr"=>["class"=>"form-switch"]])
            ->add('nom', TextType::class, ['required'=>true])
            ->add('description', CKEditorType::class, ['required'=>false])
            ->add('categorie', EntityType::class, ['class'=>Categorie::class, "choice_label"=>"nom", 'required'=>true])
            ->add('imageFile', FileType::class, ['required'=>true, "label"=>"Image"])
            ->add('produits', CollectionType::class, ['entry_type'=>ProduitType::class, 'entry_options'=>['fromSousCategorie'=>true,], "allow_add"=>true, "allow_delete"=>true, "label"=>false, "by_reference"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousCategorie::class,
        ]);
    }
}
