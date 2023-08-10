<?php

namespace App\DataFixtures;

use App\Entity\FooterContent;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FooterContentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $footerContent = new FooterContent();
        $footerContent->setTitre('Linkedin');
        $footerContent->setTag('réseau-sociaux');
        $footerContent->setUrl('https://www.linkedin.com/in/yohan-georgelin/');
        $footerContent->setIsActive(true);
        $footerContent->setImageName('linkedin.png');
        $footerContent->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($footerContent);

        $footerContent = new FooterContent();
        $footerContent->setTitre('twitter');
        $footerContent->setTag('réseau-sociaux');
        $footerContent->setUrl('https://twitter.com/?lang=fr');
        $footerContent->setUpdatedAt(new DateTimeImmutable());
        $footerContent->setImageName('twitter.png');
        $footerContent->setIsActive(true);
        $manager->persist($footerContent);
        
        $manager->flush();
    }
}
