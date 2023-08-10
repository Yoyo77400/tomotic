<?php

namespace App\DataFixtures;

use App\Entity\Contenu;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContenuFixtures extends Fixture
{
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
        $manager->persist($contenu);

        $manager->flush();
    }
}
