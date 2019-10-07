<?php

namespace App\Form;

use App\Entity\Trabajador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class TrabajadorEditType extends AbstractType
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
            ->add('pass', PasswordType::class, [
                'label' => 'Clave',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Clave'),
                'required' => false,
                'constraints' => [
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
            ->add('tipo_trabajador', ChoiceType::class, array(
                'label' => 'Tipo de Trabajador',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tipo de Trabajador'),
                'required' => false,
                'choices'  => [
                    'Supervisor' => 1,
                    'Vendedor' => 2,
                ],
            ))
            ->add('foto', HiddenType::class, array(
                'label' => 'Foto',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Foto'),
                'required' => false,
            ))
        ;
    }  

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trabajador::class,
        ]);
    }
}
