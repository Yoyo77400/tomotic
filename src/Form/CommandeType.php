<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Commande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $group = $options['group'];
        $builder
            ->add('adresse', EntityType::class, [
                'class'=>Adresse::class,
                'label'=>false,
                'required'=>true,
                'multiple'=> false,
                'expanded'=>true,
                'choices' => count($group) > 0 ? $group['adresses'] : null,
                'label_attr' => ['class'=> 'border-bottom mb-3'],
                'attr'=> ['class' => 'test'],
                'choice_attr' => count($group) > 0 ? [ 
                    $group['keyDefaultAdresse'] => ['checked' => true]
                ] : [],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'group' => [],
        ]);
    }
}
