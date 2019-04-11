<?php

namespace App\Form;

use App\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class ContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'First name'
                ],
                'label' => false

            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last name'
                ],
                'label' => false

            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'E-Mail Address'
                ],
                'label' => false

            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Subject'
                ],
                'label' => false

            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Message'
                ],
                'label' => false

            ])
            ->add('tos', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input',
                    'style' => 'width: 15%;top: 4px;position: relative;'
                ],
                'label' => 'I accept the EAER website',
                'label_attr' => [
                    'style' => 'display: inline-block!important; font-weight: 900;width: 15%;position: relative;top: 10px;'
                ],
                'constraints' => new IsTrue()
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary btn-lg'
                ],
                'label' => 'Send Message'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}
