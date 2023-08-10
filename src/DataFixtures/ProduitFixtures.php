<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SousCategorieFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const GOOGLE_HOME_BLANCHE = "google-home-blanche";
    public const SONOS_MOVE = "sonos-move";
    public const SAMSUNG_GALAXY_S23_ULTRA = "samsung-galaxy-s23-ultra";
    public const IPHONE_14_PRO_MAX = "iphone-14-pro-max";
    public const PRISE_CONNECTEE_EVE_ENERGY = "prise-connectee-eve-energy";
    public const SHELLY_DUO_RGB = "shelly-duo-rgb";
    public const SONOFF_PANNEAU_DE_CONTROLE = "sonoff-panneau-de-controle";
    public const CONTROLPRO_DC_4_250 = "controlpro-dc-4-250";

    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $produit = new Produit();
        $produit->setNom('Google Home Blanche');
        $produit->setSlug('google-home-blanche');
        $produit->setPrix(98.80);
        $produit->setDescription('Google Home Enceinte Blanche sans fil Wi-Fi à commande vocale avec Assistant Google');
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::ENCEINTES_CONNECTEES));
        $manager->persist($produit);
        $this->addReference(self::GOOGLE_HOME_BLANCHE, $produit);

        $produit = new Produit();
        $produit->setNom('Sonos Move');
        $produit->setSlug('sonos-move');
        $produit->setPrix(449.95);
        $produit->setDescription("Bénéficiez d'un son remarquable, partout, avec l'enceinte Sonos Move, résistante aux chocs et intempéries. Profitez du contrôle vocal, de l'application Sonos et d'Apple AirPlay 2 à la maison, et diffusez en Bluetooth lorsque le Wi-Fi n'est pas disponible.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::ENCEINTES_CONNECTEES));
        $manager->persist($produit);
        $this->addReference(self::SONOS_MOVE, $produit);

        $produit = new Produit();
        $produit->setNom('Samsung Galaxy S23 Ultra');
        $produit->setSlug('samsung-galaxy-s23-ultra');
        $produit->setPrix(1379.00);
        $produit->setDescription("Une conception nouvelle pour un impact moindre
        Le Galaxy S23 Ultra embarque tout le savoir-faire Samsung au cœur d'une conception minimaliste et unique en son genre. Avec l'intégration de matériaux recyclés dans le verre des faces avant et arrière, ou l'utilisation de colorants composés de pigments naturels pour le traitement du cadre en aluminium, sa fabrication a été entièrement repensée. Pour un smartphone plus respectueux de l'environnement.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::SMARTPHONES));
        $manager->persist($produit);
        $this->addReference(self::SAMSUNG_GALAXY_S23_ULTRA, $produit);

        $produit = new Produit();
        $produit->setNom('iPhone 14 Pro Max');
        $produit->setSlug('iphone-14-pro-max');
        $produit->setPrix(1479.00);
        $produit->setDescription("Ultra lumineux et équipé de la fonctionnalité always-on, l'iPhone 14 Pro Max propose une super dalle OLED de 6,7 pouces. Il embarque également un nouveau module caméra, avec un nouvel ultra-grand-angle, un zoom optique x3 et, surtout, un capteur de 48 Mpx.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::SMARTPHONES));
        $manager->persist($produit);
        $this->addReference(self::IPHONE_14_PRO_MAX, $produit);

        $produit = new Produit();
        $produit->setNom('Prise connectée Eve Energy');
        $produit->setSlug('prise-connectee-eve-energy');
        $produit->setPrix(39.95);
        $produit->setDescription("
        La prise connectée Eve Energy intègre Matter et le réseau Thread, des technologies de pointe. Et ce sans risque de suivi, pour une maison connectée universelle et fiable qui préserve votre confidentialité. Allumez et éteignez vos éclairages et appareils électroménagers à l’aide d’une app ou d’une commande vocale, et contrôlez-les à distance. L’app Eve pour iPhone et iPad, gratuite, vous permet de tirer le meilleur parti de votre prise Eve Energy : suivez vos économies d’énergie, créez des programmes qui permettent à vos appareils de fonctionner de manière autonome, et profitez de fonctionnalités de personnalisation avancées.
        
        La prise Eve Energy certifiée TÜV et compatible avec la technologie Matter est extrêmement facile à utiliser et garantit une sécurité avancée. Tous les membres de votre famille peuvent contrôler la maison, qu’ils utilisent un iPhone, un appareil Android, une enceinte intelligente intégrant Alexa, Siri ou encore l’Assistant Google. Eve Energy se configure en quelques étapes seulement, à l’aide de l’app ou de l’assistant vocal de votre plateforme préférée. Le seul autre élément à mettre en place est un hub, en utilisant la ou les plateformes de votre choix.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::ELECTRICITE_CONNECTEE));
        $manager->persist($produit);
        $this->addReference(self::PRISE_CONNECTEE_EVE_ENERGY, $produit);

        $produit = new Produit();
        $produit->setNom('Shelly Duo – RGBW');
        $produit->setSlug('shelly-duo-rgb');
        $produit->setPrix(14.52);
        $produit->setDescription("L’innovante Shelly Duo RVBW est une ampoule WiFi qui vous permet de régler la luminosité et la couleur de votre environnement à l’aide du curseur de gradation approprié en fonction de votre humeur.
        Il s’agit de vous faciliter la vie avec l’ampoule Wi-Fi RVB + W (blanche) la plus intelligente au monde.
        Cette ampoule multifonction est idéale pour une installation sur une douille standard de type E27. De plus, le Shelly Duo RVBW dispose également d’un serveur Web intégré.
        Elle supporte également les commandes vocales Amazon Alexa et Google Home pour créer vos routines quotidiennes telles que l’allumage et l’éteinte.
        
        Grâce à l’utilisation des trois couleurs de base, c’est-à-dire le rouge, le vert et le bleu, nous pouvons laisser libre cours à notre imagination pour créer une variété infinie de couleurs et donner une touche supplémentaire de vitalité à notre cadre de vie.
        De plus, nous pouvons également utiliser la nuance de blanc qui permet à notre Duo RVBW de se démarquer des éclairages RGB classiques. Vous pouvez personnaliser votre éclairage avec une palette de centaines de couleurs RVB et 4000K Natural White.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::ELECTRICITE_CONNECTEE));
        $manager->persist($produit);
        $this->addReference(self::SHELLY_DUO_RGB, $produit);

        $produit = new Produit();
        $produit->setNom('Sonoff - Panneau de commande Wifi NSPanel PRO');
        $produit->setSlug('sonoff-panneau-de-controle-wifi-nspanel-pro');
        $produit->setPrix(146.10);
        $produit->setDescription("Panneau de commande de la maison intelligente NSPanel PRO - NSPanel86P – SONOFFPropriétaire ou futur résident d'une maison connectée, le NSPanel86P est fait pour vous. Il a été conçu pour faciliter le contrôle de tous les appareils de votre smart home allant de l'éclairage, aux fenêtres et rideaux électriques en passant par les appareils de chauffage et de refroidissement. En un simple clic et à distance, vous gardez facilement le contrôle de vos appareils connectés grâce à cet équipement de la marque SONOFF.Le panneau de commande de la maison intelligente - NSPanel86P fonctionne avec eWeLink Cast. Toutefois, vous pouvez également contrôler les appareils pris en charge par eWeLink. Il permet de surveiller tous les appareils SONOFF ainsi que ceux des autres marques avec les protocoles standard Zigbee 3.0.Vous pouvez être rassurés où que vous soyez, car cet outil offre une surveillance en temps réel de votre maison.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::PANNEAU_DE_CONTROLE));
        $manager->persist($produit);
        $this->addReference(self::SONOFF_PANNEAU_DE_CONTROLE, $produit);

        $produit = new Produit();
        $produit->setNom('Controlpro DC-4-250');
        $produit->setSlug('controlpro-dc-4-250');
        $produit->setPrix(4099.00);
        $produit->setDescription("Cette version de Controlpro est idéale pour la présentation claire d'un système de contrôle domestique graphiquement sophistiqué. Le généreux écran tactile 18,5'' Full HD incluant la visualisation YOUVI affiche les fonctions de contrôles à un point central dans la KNX Smart Home. Le panneau Smart Home est conçu pour un fonctionnement à long terme et durable et peut être utilisé comme client (par exemple avec le Gira Homeserver) ou comme serveur indépendant. Une connexion KNX intégrée et le logiciel inclus rendent tout cela possible. Toutes les envies de design sont réalisables grâce à la façade en verre adaptable individuellement.");
        $produit->setIsActive(true);
        $produit->setSousCategorie($this->getReference(SousCategorieFixtures::PANNEAU_DE_CONTROLE));
        $manager->persist($produit);
        $this->addReference(self::CONTROLPRO_DC_4_250, $produit);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SousCategorieFixtures::class,
        ];
    }
}
