<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setName('Christian Bale');
        //$actor->addMovie();
        $manager->persist($actor);

        $actor2 = new Actor();
        $actor2->setName('Heath Ledger');
        //$actor2->setReleaseYear(2012);
        $manager->persist($actor2);

        $actor3 = new Actor();
        $actor3->setName('Robert Downey Jr');
        //$actor3->setReleaseYear(2008);
        $manager->persist($actor3);

        $actor4 = new Actor();
        $actor4->setName('Chris Evans');
        //$actor3->setReleaseYear(2008);
        $manager->persist($actor4);

        $manager->flush();
    }
}
