<?php

namespace App\DataFixtures;

use App\Entity\SousCategorie;
use App\DataFixtures\CategorieFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SousCategorieFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const ENCEINTES_CONNECTEES = "enceintes-connectees";
    public const SMARTPHONES = "smartphones";
    public const ELECTRICITE_CONNECTEE = "electricite connectee";
    public const PANNEAU_DE_CONTROLE = "panneau-de-controle";

    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $sousCategorie = new SousCategorie();
        $sousCategorie->setNom('Enceintes connectées');
        $sousCategorie->setSlug('enceintes-connectees');
        $sousCategorie->setIsActive(true);
        $sousCategorie->setImageName('orateur.png');
        $sousCategorie->setCategorie($this->getReference(CategorieFixtures::ACCESSOIRES));
        $manager->persist($sousCategorie);
        $this->addReference(self::ENCEINTES_CONNECTEES, $sousCategorie);

        $sousCategorie = new SousCategorie();
        $sousCategorie->setNom('Smartphones');
        $sousCategorie->setSlug('smartphones');
        $sousCategorie->setIsActive(true);
        $sousCategorie->setImageName('telephone-intelligent.png');
        $sousCategorie->setCategorie($this->getReference(CategorieFixtures::ACCESSOIRES));
        $manager->persist($sousCategorie);
        $this->addReference(self::SMARTPHONES, $sousCategorie);

        $sousCategorie = new SousCategorie();
        $sousCategorie->setNom('Electricité connectée');
        $sousCategorie->setSlug('electicite-connectee');
        $sousCategorie->setIsActive(true);
        $sousCategorie->setImageName('ampoule-connectee.png');
        $sousCategorie->setCategorie($this->getReference(CategorieFixtures::DOMOTIQUE));
        $manager->persist($sousCategorie);
        $this->addReference(self::ELECTRICITE_CONNECTEE, $sousCategorie);

        $sousCategorie = new SousCategorie();
        $sousCategorie->setNom('Panneau de contrôle');
        $sousCategorie->setSlug('panneau-de-controle');
        $sousCategorie->setIsActive(true);
        $sousCategorie->setImageName('controle-panel.png');
        $sousCategorie->setCategorie($this->getReference(CategorieFixtures::DOMOTIQUE));
        $manager->persist($sousCategorie);
        $this->addReference(self::PANNEAU_DE_CONTROLE, $sousCategorie);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }

    public static function getGroups(): array
    {
        return ['produits'];
    }
}
