<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function getOrder():int{
        return 2;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for($i = 0; $i < 10; $i++){
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
        };
        $manager->flush();
    }
}
