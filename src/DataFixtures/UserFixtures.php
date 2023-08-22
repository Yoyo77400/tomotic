<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    private $encoder; 

    // ====================================================== //
    // ==================== CONSTRUCTEUR ==================== //
    // ====================================================== //
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setNom('Georgelin');
        $user->setPrenom('Yohan');
        $user->setEmail('yohan.georgelin@gmail.com');
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPassword($this->encoder->hashPassword($user, "ToMoTiC-3!14"));
        $user->setIsVerified(true);
        $manager->persist($user);

        $user = new User();
        $user->setNom('Test');
        $user->setPrenom('Toto');
        $user->setEmail('toto.test@gmail.com');
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->encoder->hashPassword($user, "P@ssWord"));
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
