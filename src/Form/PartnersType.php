<?php

namespace App\Form;

use App\Entity\Partners;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Partner name'
            ])
            ->add('logo', TextType::class, [
                'label' => 'Partner logo',
                'attr' => [
                    'placeholder' => 'Logo URL (remember path partners/)'
                ]
            ])
            ->add('description', CKEditorType::class)
            ->add('name', TextType::class, [
                'label' => 'Slug',
                'attr' => [
                    'placeholder' => 'Insert a slug for page'
                ]
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => TextType::class,
                'attr' => [
                    'placeholder' => 'List of URLs, separated by comma'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success pull-right'],
                'label' => 'Add new Partner'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partners::class,
        ]);
    }
}
