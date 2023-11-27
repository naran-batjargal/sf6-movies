<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseYear(2008);
        $movie->setDescription('Description');
        $movie->setImagePath('https://media.istockphoto.com/id/1417416515/photo/fantasy-girl-with-brown-hair-swinging-sword-in-cloak-and-crown-in-forest.webp?s=1024x1024&w=is&k=20&c=YrujLHyinUNTkztnCbNMt6KrGm8-nVlrasbMJngd_to=');
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));
        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Avengers');
        $movie2->setReleaseYear(2012);
        $movie2->setDescription('Description');
        $movie2->setImagePath('https://hips.hearstapps.com/hmg-prod/images/marvel-1676501297.jpeg?resize=1200:*');
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));
        $manager->persist($movie2);

        $movie3 = new Movie();
        $movie3->setTitle('Wonder woman');
        $movie3->setReleaseYear(2008);
        $movie3->setDescription('Description');
        $movie3->setImagePath('https://static.wikia.nocookie.net/dccu/images/6/6f/JL_Wonder_Woman.jpg/revision/latest?cb=20160914003449');
        $movie3->addActor($this->getReference('actor_1'));
        $movie3->addActor($this->getReference('actor_3'));
        $manager->persist($movie3);

        $manager->flush();
    }
}
