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
    public function index(SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get("panier", []);
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
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

        $sessionInterface->set("panier",$panier);
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
        $sessionInterface->set("panier",$panier);

        return $this->redirectToRoute("app_panier_index");
    }

    #[Route('/panier/delete/{id}', name: 'app_panier_delete_produit')]
    public function delete(Produit $produit,SessionInterface $sessionInterface)
    {
        $panier = $sessionInterface->get("panier", []);
        $id = $produit->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        return $this->redirectToRoute("app_panier_index");
    }

    #[Route('/panier/delete', name: 'app_panier_delete_panier')]
    public function deleteAll(SessionInterface $sessionInterface)
    {
        $sessionInterface->remove("panier");

        return $this->redirectToRoute("app_panier_index");
    }
}
