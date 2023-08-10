<?php

namespace App\DataFixtures;

use App\Entity\Home;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HomeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $home = new Home();
        $home->setTitre("TOMOTIC Les maisons de demain");
        $home->setTexte(" Site de ventes de solutions connectées sur mesures pour particuliers et professionnels, ainsi que de produits domotique!");
        $home->setIsActive(true);
        $home->setImageName('tomotic.png');

        $manager->persist($home);
        $manager->flush();
    }
}
