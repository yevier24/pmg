<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\IsTrue;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array(
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'email'),
                'required' => true,
            ))
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Clave',
                'mapped' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Clave'),
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('name', TextType::class, array(
                'label' => 'Nombre',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Nombre'),
                'required' => true,
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Teléfono',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Teléfono'),
                'required' => false,
            ))
            ->add('address', TextType::class, array(
                'label' => 'Dirección',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Dirección'),
                'required' => false,
            ))
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
