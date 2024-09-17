<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['attr' => ['class'=>'input']])
            ->add('price', null, ['attr' => ['class'=>'input price']])
            ->add('stockXS', null, ['attr' => ['class'=>'input stock']])
            ->add('stockS', null, ['attr' => ['class'=>'input stock']])
            ->add('stockM', null, ['attr' => ['class'=>'input stock']])
            ->add('stockL', null, ['attr' => ['class'=>'input stock']])
            ->add('stockXL', null, ['attr' => ['class'=>'input stock']])
            ->add('image', FileType::class, [
                'label' => 'Image du produit',
                'mapped' => false,
                'attr' => ['class'=>'input form-control-sm'],
                'constraints' => [
                    new File([
                        'maxSize'=>'1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'maxSizeMessage'=>'L\'image doit faire maximum 1024 ko',
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, JPEG ou PNG)',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
