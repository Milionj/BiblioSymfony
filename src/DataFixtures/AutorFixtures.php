<?php

namespace App\DataFixtures;
use App\Entity\Autor;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AutorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $autor = new Autor();
            $autor->setLastname($faker->name);
            $autor->setFistname($faker->name);
            $manager->persist($autor);
        }

       $manager->flush();
    }
}
