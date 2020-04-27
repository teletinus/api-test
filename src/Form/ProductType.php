<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Product;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, [
                    'label' => 'Product Name',
                    'required' => false,
                    'attr' => [
                        'maxlength' => 50
                    ],
                    'label_attr' => [
                        'class' => 'required'
                    ]
                ])
                ->add('product_id', NumberType::class, [
                    'label' => 'Product ID',
                    'required' => false,
                    'html5'=> true,
                    'label_attr' => [
                        'class' => 'required'
                    ]
                ])
                ->add('manager', TextType::class, [
                    'label' => 'Product Manager',
                    'required' => false,
                    'attr' => [
                        'maxlength' => 30
                    ]
                ])
                ->add('sales_start_date',  TextType::class, [
                    'label' => 'Sales start date',
                    'required' => false,
                    'attr' => [
                        'class' => 'js-datepicker'
                    ],
                    'label_attr' => [
                        'class' => 'required'
                    ]
                ])
                ->add('save', SubmitType::class, [
                    'attr' => [
                        'class' => 'btn-success float-left mr-1'
                    ]
                ])
                ->add('reset', ResetType::class, [
                    'attr' => [
                        'class' => 'btn-danger'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'csrf_protection' => false
        ]);
    }

}
