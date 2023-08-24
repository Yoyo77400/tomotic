<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier_index')]
    public function index(SessionInterface $sessionInterface, ProduitRepository $produitRepository): Response
    {
        $panier = $sessionInterface->get("panier", []);
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $produit = $produitRepository->find($id);
            $prix = $produit->getPrix();
            if($produit->getDiscount()){
                $prix = $produit->getPrix()-($produit->getPrix()*$produit->getDiscount()/100);
            }
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite,
                "prix" => $prix
            ];
            $total += $prix * $quantite;
        }

        return $this->render('panier/index.html.twig', [
            'dataPanier' => $dataPanier,
            "total" => $total,
        ]);
    }

    #[Route('/panier/add/{id}', name: 'app_panier_add')]
    public function add( Produit $produit , SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $produit->getId();

        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        $sessionInterface->set("panier", $panier);
        return $this->redirectToRoute("app_panier_index");
    }

    #[Route('/panier/remove/{id}', name: 'app_panier_remove')]
    public function remove( Produit $produit , SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $produit->getId();

        if(!empty($panier[$id]))
        {
            if($panier[$id] > 1 ){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        $sessionInterface->set("panier", $panier);

        return $this->redirectToRoute("app_panier_index");
    }

    #[Route('/panier/delete/{id}', name: 'app_panier_delete')]
    public function delete(Produit $produit,SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $produit->getId();
        unset($panier[$id]);

        $sessionInterface->set("panier", $panier);
    
        return $this->redirectToRoute("app_panier_index");
    }

    #[Route('/panier/delete', name: 'app_panier_delete_panier')]
    public function deleteAll(SessionInterface $sessionInterface)
    {
        $sessionInterface->remove("panier");

        return $this->redirectToRoute("app_panier_index");
    }
}
