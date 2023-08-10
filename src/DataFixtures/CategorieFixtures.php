<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const ACCESSOIRES = "accessoires";
    public const DOMOTIQUE = "domotique";

    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $categorie = new Categorie();
        $categorie->setNom('Accessoires');
        $categorie->setSlug('accessoires');
        $categorie->setDescription('Tous vos accessoires connéctée pour votre maison');
        $categorie->setImageName('internet-des-objets.png');
        $categorie->setIsActive(true);
        $manager->persist($categorie);
        $this->addReference(self::ACCESSOIRES, $categorie);

        $categorie = new Categorie();
        $categorie->setNom('Domotique');
        $categorie->setSlug('domotique');
        $categorie->setDescription('Tous vos équipements connectés pour la maison');
        $categorie->setImageName('domotique.png');
        $categorie->setIsActive(true);
        $manager->persist($categorie);
        $this->addReference(self::DOMOTIQUE, $categorie);

        $manager->flush();
    }
}
