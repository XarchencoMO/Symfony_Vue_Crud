<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'required' => true,
                'constraints' => [new Length(['max' => 255])],
            ])
            ->add('categories', EntityType::class, [
                'class'     => Category::class,
//                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('description', TextType::class, [
                'constraints' => [new Length(['max' => 2048])],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
