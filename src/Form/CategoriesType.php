<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Category name'
                ],
                'label' => 'Category Name'
            ])
            ->add('parent', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Father category (default 0)'
                ],
                'label' => 'Father Category (default 0)'
            ])
            ->add('flag', TextType::class, [
                'attr' => [
                    'placeholder' => 'Flag URL (put images in folder flags/)'
                ],
                'label' => 'Flag/Image'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ],
                'label' => 'Add'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}