<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private string $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu eros ut urna hendrerit tincidunt. Etiam viverra dolor ut urna molestie facilisis. Duis eu efficitur massa.';

    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<6; $i++){

            $category = new Category();
            $category->setName('category '.$i);

            $manager->persist($category);
        }

        $manager->flush();



        for($i=1; $i<6; $i++){

            $product = new Product();
            $product->setName('product '.$i);
            $added_category = $manager->find(Category::class, $i);
            $product->addCategory($added_category);
            $product->setDescription($this->description);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
