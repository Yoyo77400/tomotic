<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\DataFixtures\ContenuFixtures;
use App\DataFixtures\ProduitFixtures;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $image = new Image();
        $image->setImageName("google-home-blanche.jpg");
        $image->setDescription("Google Home Blanche");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::GOOGLE_HOME_BLANCHE));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("sonos-move.jpg");
        $image->setDescription("Sonos Move Noire enceinte connectée");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::SONOS_MOVE));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("samsung-galaxy-s23-ultra.webp");
        $image->setDescription("Samsung Galaxy S23 Ultra");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::SAMSUNG_GALAXY_S23_ULTRA));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("iphone-14-pro.jpg");
        $image->setDescription("Iphone 14 pro Max");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::IPHONE_14_PRO_MAX));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("prise-connectee-eve-energy.jpg");
        $image->setDescription("Prise connectée eve energy");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::PRISE_CONNECTEE_EVE_ENERGY));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("shelly-duo-rgbw.jpg");
        $image->setDescription("Ampoule Shelly Duo RGBW");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::SHELLY_DUO_RGB));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("sonoff-control-panel.jpeg");
        $image->setDescription("Panneau de controle SONOFF");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::SONOFF_PANNEAU_DE_CONTROLE));
        $manager->persist($image);

        $image = new Image();
        $image->setImageName("peaknx-shop-controlpro.jpg");
        $image->setDescription("Panneau de controlpro de PEAKNX shop");
        $image->setRankOrder(1);
        $image->setUpdatedAt(new DateTimeImmutable());
        $image->setProduit($this->getReference(ProduitFixtures::CONTROLPRO_DC_4_250));
        $manager->persist($image);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProduitFixtures::class,
            ContenuFixtures::class,
        ];
    }
}
