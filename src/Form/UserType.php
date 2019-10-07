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

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array(
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'email'),
                'required' => true,
            ))
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Clave',
                'mapped' => false,
                'attr' => array(
                    'class' => 'form-control',
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
                    'placeholder' => 'Nombre'),
                'required' => true,
            ))
            ->add('phone', TextType::class, array(
                'label' => 'Teléfono',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Teléfono'),
                'required' => false,
            ))
            ->add('address', TextType::class, array(
                'label' => 'Dirección',
                'attr' => array(
                    'class' => 'form-control',
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
