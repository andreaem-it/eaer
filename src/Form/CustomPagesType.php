<?php

namespace App\Form;

use App\Entity\CustomPages;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomPagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page_name')
            ->add('content', CKEditorType::class)
            ->add('hasCover')
            ->add('coverImage', TextType::class, ['attr' => ['placeholder' => 'Leave blank if page has no cover image'], 'required' => false])
            ->add('published')
            ->add('submit', SubmitType::class, ['label' => 'Save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomPages::class,
        ]);
    }
}
