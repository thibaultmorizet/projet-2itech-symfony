<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('John Wick Parabellum');
        $movie->setYear('2019');
        $movie->setType('Action');
        $manager->persist($movie);
        
        $movie2 = new Movie();
        $movie2->setTitle('Old');
        $movie2->setYear('2021');
        $movie2->setType('Horreur');
        $manager->persist($movie2);

        $movie3 = new Movie();
        $movie3->setTitle('Titanic');
        $movie3->setYear('1997');
        $movie3->setType('Romance');
        $manager->persist($movie3);
        
        $movie4 = new Movie();
        $movie4->setTitle('Venom');
        $movie4->setYear('2018');
        $movie4->setType('Action');
        $manager->persist($movie4);

        $movie5 = new Movie();
        $movie5->setTitle('Suicide Squad');
        $movie5->setYear('2016');
        $movie5->setType('Fantasy');
        $manager->persist($movie5);
        
        $movie6 = new Movie();
        $movie6->setTitle('Ready Player One');
        $movie6->setYear('2018');
        $movie6->setType('Science-Fiction');
        $manager->persist($movie6);
        $manager->flush();
    }
}
