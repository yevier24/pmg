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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TrabajadorType extends AbstractType
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
            ->add('pass', PasswordType::class, [
                'label' => 'Clave',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Clave'),
                'required' => true,
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
                    'value'=> '',
                    'placeholder' => 'Nombre'),
                'required' => true,
            ))
            ->add('rut', TextType::class, array(
                'label' => 'Rut',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'oninput' => 'checkRut(this)',
                    'placeholder' => 'Rut'),
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
            ->add('tipo_trabajador', ChoiceType::class, array(
                'label' => 'Tipo de Trabajador',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Tipo de Trabajador'),
                'required' => true,
                'choices'  => [
                    'Supervisor' => 1,
                    'Vendedor' => 2,
                ],
            ))
            ->add('supervisor', EntityType::class, [
                'class' => Trabajador::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.tipo_trabajador = :searchTerm')
                    ->setParameter('searchTerm', 1);
                },
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'form-control'
                    ),
            ])
            ->add('foto', HiddenType::class, array(
                'label' => 'Subir Foto',
                'attr' => array(
                    'class' => 'form-control',
                    'value'=> '',
                    'placeholder' => 'Subir Foto'),
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
