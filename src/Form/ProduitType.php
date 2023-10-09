<?php

namespace App\Form;

use App\Entity\Produit;
use App\Form\ImageType;
use App\Entity\SousCategorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('slug')
            ->add('isActive', CheckboxType::class, [
                "required"=>false, 
                "label"=>"Active", 
                "attr"=>[
                    "class"=>"form-check-input"
                ], 
                "row_attr"=>[
                    "class"=>"form-switch"
                    ]
                ])
            ->add('nom', TextType::class, ["required"=>true])
            ->add('description', CKEditorType::class, [
                "required"=>false, 
                'config_name' => 'my_config', 
                "input_sync"=>true
                ])
            ->add('prix', MoneyType::class, ["required"=>true])
            ->add('discount', NumberType::class, ["required"=>false])
            ->add("images", CollectionType::class, [
                "entry_type"=>ImageType::class, 
                "entry_options"=>[
                    'fromProduit'=>true, 
                    'isNew'=>$options['isNew']
                ], 
                "allow_add"=>true, 
                "allow_delete"=>true, 
                "label"=>false, 
                "by_reference"=>false])
        ;
        if(!$options['fromSousCategorie']){
            $builder
                ->add('sousCategorie', EntityType::class, [
                    "class"=>SousCategorie::class, 
                    "choice_label"=>"nom", 
                    "required"=>true
                    ])
                ;
        }else{
            $builder
                ->remove('images')
                ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            "fromSousCategorie"=>false,
            'isNew'=>true
        ]);
    }
}
