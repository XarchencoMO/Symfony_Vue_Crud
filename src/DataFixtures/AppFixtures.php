<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private string $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu eros ut urna hendrerit tincidunt. Etiam viverra dolor ut urna molestie facilisis. Duis eu efficitur massa.';

    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<10; $i++){
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription($this->description);

            // TODO: Добавить категории

            $manager->persist($product);
        }

        $manager->flush();
    }
}
