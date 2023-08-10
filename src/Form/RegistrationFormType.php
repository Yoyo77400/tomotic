<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['required'=>false])
            ->add('prenom', TextType::class, ['required'=>false])
            ->add('email', EmailType::class, ["label"=>"Votre Email", "required"=>true])
            ->add('telephone', TextType::class, ['required'=>false])
            ->add('dateDeNaissance', BirthdayType::class, ['required'=>false, 'label'=>'Date de naissance'])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=> "J'accepte les conditions générales d'utilisation.",
                'constraints' => [
                    new IsTrue([
                        'message' => "J'accepte les conditions générales d'utilisation.",
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type'=> PasswordType::class,
                'mapped' => false,
                // 'attr' => ['autocomplete' => 'new-password'],
                'invalid_message'=>'Les mots de passe ne sont pas identiques.',
                'required'=>true,
                'first_options'=> [
                    "label"=>"Mot de passe", 
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options'=>["label"=>"Confirmer le mot de passe!"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
