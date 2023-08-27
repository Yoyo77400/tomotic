<?php

namespace App\Form;

use App\Entity\Contenu;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive', CheckboxType::class, ["required"=>false, "label"=>"Active", "attr"=>["class"=>"form-check-input"], "row_attr"=>["class"=>"form-switch"]])
            ->add('titre', TextType::class, ['required'=>true])
            ->add('contenu', CKEditorType::class, ['required'=>true])
            ->add('tag', TextType::class, ['required'=>true])
            ->add('rankOrder', NumberType::class, ['required'=>true])
            ->add("images", CollectionType::class, ["entry_type"=>ImageType::class, "entry_options"=>['fromProduit'=>true, 'isNew'=>$options['isNew']], "allow_add"=>true, "allow_delete"=>true, "label"=>false, "by_reference"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contenu::class,
            'isNew'=>true
        ]);
    }
}
