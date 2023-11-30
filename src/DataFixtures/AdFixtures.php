<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ad;

class AdFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ad = new Ad();
        $ad->setContent('Ad1');
        $manager->persist($ad);

        $ad2 = new Ad();
        $ad2->setContent('Ad2');
        $manager->persist($ad2);

        $ad3 = new Ad();
        $ad3->setContent('Ad3');
        $manager->persist($ad3);

        $manager->flush();
    }
}
