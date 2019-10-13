<?php

namespace App\Form;

use App\Entity\Tienda;
use App\Entity\Empresa;

use App\Entity\Zona;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TiendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u');
                },
                'choice_label' => 'name',
                'label' => 'Cadena',
                'attr' => array(
                    'class' => 'form-control'
                    ),
            ])
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre Tienda',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nombre Tienda'),
                'required' => true,
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Dirección'),
                'required' => true,
            ))
            ->add('descripcion', TextType::class, array(
                'label' => 'Descripción',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Descripción'),
                'required' => true,
            ))
            ->add('zona', EntityType::class, [
                'class' => Zona::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u');
                },
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'form-control'
                    ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tienda::class,
        ]);
    }
}
