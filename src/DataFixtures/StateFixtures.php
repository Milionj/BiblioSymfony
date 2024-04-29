<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $states = ['Neuf', 'Bon', 'Usé', 'Endommagé'];

        foreach ($states as $stateName) {
            $state = new State();
            $state->setName($stateName);
            $manager->persist($state);

        }
        $manager->flush();
    }
}