<?php

namespace App\DataFixtures;

use App\Entity\Contenu;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ContenuFixtures extends Fixture implements FixtureGroupInterface
{

// ====================================================== //
// ===================== PROPRIETES ===================== //
// ====================================================== //
    public const CONDITION_GENERALE_DE_VENTE = "condition-générale-de-vente";
    public const A_PROPOS_DE_NOUS = "a-propos-de-nous";
    public const SOLUTIONS_AUX_PARTICULIERS = "solutions-aux-particuliers";
    public const SOLUTIONS_PROFESSIONNELS = "solutions-professionnels";
    public const SURVEILLANCE_ET_SECURITE = "surveillance-et-securite";
    public const NOS_PRODUITS_CONNECTES = "nos-produits-connectes";

// ====================================================== //
// ====================== METHODES ====================== //
// ====================================================== //
    public function load(ObjectManager $manager): void

    {
        $contenu = new Contenu();
        $contenu->setTitre('Condition générale de vente');
        $contenu->setContenu("CONDITIONS GÉNÉRALES DE VENTE
        Prix et paiement
        Les prix des produits n’incluent pas les frais de livraison. Les prestations de livraison et de montage sont
        facturées en sus conformément à nos tarifs. La vente doit être validée par le paiement d’un acompte au
        moins égal à :
        - 50% en cas de commande d’une cuisine,
        - 70% pour tout autre produit commandé,
        le solde doit être réglé avant la délivrance de la marchandise emportée ou livrée.
        En cas de vente à crédit, la marchandise ne pourra être remise qu’après acceptation du dossier par
        l’Organisme de crédit et écoulement du délai de rétractation. Les marchandises restent la propriété de
        Conforama jusqu’au complet paiement du prix et retrait/livraison de celles-ci.
        Le défaut de paiement pourra entraîner la revendication des produits par Conforama. Les dispositions
        ci-dessus ne font pas obstacle, à compter du retrait ou de la livraison des produits, au transfert au profit
        du Client des risques de perte ou de détérioration des produits ainsi que des dommages qu’ils pourraient
        occasionner...");
        $contenu->setTag("CGV");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::CONDITION_GENERALE_DE_VENTE, $contenu);

        $contenu = new Contenu();
        $contenu->setTitre('A propos de nous');
        $contenu->setContenu("TOMOTIC est une jeune entreprise souhaitant se focaliser sur le concept de “smart home” et des solutions connectées pour répondre à des exigences d’amélioration de nos consomations du quotidien. Elle vise à proposer des solutions, à l’aide d’équipes passionnées, qui vous permettront d’allier confort, sécurité et économies d’énergie ! Nos experts sont là pour vous aider, que vous soyez un particulier ou un professionnel. Nous proposons des services qui sauront s’adapter à vos besoins ! N’hésitez plus, et découvrez avec nous la solution qui vous correspond ! ");
        $contenu->setTag("a-propos-de-nous");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::A_PROPOS_DE_NOUS, $contenu);

        $contenu = new Contenu();
        $contenu->setTitre('Solutions aux particuliers');
        $contenu->setContenu("Vous êtes un particulier et vous souhaitez réaliser un projet sur mesure pour votre maison ?  N’hésitez pas à prendre rendez vous avec un de nos experts, ou demander une estimation en ligne !");
        $contenu->setTag("solutions-du-site");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::SOLUTIONS_AUX_PARTICULIERS, $contenu);

        $contenu = new Contenu();
        $contenu->setTitre('Solutions professionnels');
        $contenu->setContenu("Vous êtes le représentant d’une entreprise, et avez besoin d’une solution personnalisée pour aménager un bâtiment, un bureau? Nos experts sont la pour vous !");
        $contenu->setTag("solutions-du-site");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::SOLUTIONS_PROFESSIONNELS, $contenu);

        $contenu = new Contenu();
        $contenu->setTitre('Surveillance et Sécurité');
        $contenu->setContenu("Vous pouvez demander auprès de nos experts une solution personnalisée pour la mise en place d’un système de surveillance vidéo ou alarme. ");
        $contenu->setTag("solutions-du-site");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::SURVEILLANCE_ET_SECURITE, $contenu);

        $contenu = new Contenu();
        $contenu->setTitre('Nos produits connectés');
        $contenu->setContenu("Retrouvez sur notre site tous nos produits disponibles, dans toutes nos catégories. De la prise connectés, jusqu’aux appareils éléctroménagés et de sécurité.");
        $contenu->setTag("solutions-du-site");
        $contenu->setRankOrder(1);
        $contenu->setIsActive(true);
        $manager->persist($contenu);
        $this->addReference(self::NOS_PRODUITS_CONNECTES, $contenu);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['contenu'];
    }
}
