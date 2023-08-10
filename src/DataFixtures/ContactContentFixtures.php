<?php

namespace App\DataFixtures;

use App\Entity\ContactContent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactContentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new ContactContent();
        $contact->setTitre('Contact Tomotic');
        $contact->setAdresse('2 allée de luzancy, 77400 Pomponne');
        $contact->setEmail('toto@gmail.com');
        $contact->setTelephone('00.00.00.00.00');
        $manager->persist($contact);

        $manager->flush();
    }
}
