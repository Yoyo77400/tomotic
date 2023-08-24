<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('roles')
            ->remove('isVerified')
            ->remove('password')
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type'=> PasswordType::class,
                'mapped' => false,
                // 'attr' => ['autocomplete' => 'new-password'],
                'invalid_message'=>'Les mots de passe ne sont pas identiques.',
                'required'=>false,
                'first_options'=> [
                    "label"=>"Mot de passe", 
                    "required"=>false,
                ],
                'second_options'=>["label"=>"Confirmer le mot de passe!", "required"=>false],
            ])
            ->add('nom', TextType::class, ['required'=>false])
            ->add('prenom', TextType::class, ['required'=>false])
            ->add('telephone', TextType::class, ['required'=>false])
            ->add('dateDeNaissance', BirthdayType::class, ['required'=>false])
            ->add('modifier', SubmitType::class, ["attr"=>['class'=>"btn btn-green-tomotic mt-3 ms-2"]])
            ->add('modifierAdresse', SubmitType::class, ["attr"=>['class'=>"btn btn-green-tomotic mt-3 ms-2"], "label"=>"Modifier"])
            ->add('adresses', CollectionType::class, ['entry_type'=>AdresseType::class, "entry_options"=>['fromUser'=>true], "allow_add"=>true, "allow_delete"=>true, "label"=>false, "by_reference"=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
