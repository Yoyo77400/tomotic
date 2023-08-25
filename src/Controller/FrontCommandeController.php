<?php

namespace App\Controller;

use App\Form\CommandeType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FrontCommandeController extends AbstractController
{
    #[Route('/commande/create', name: 'app_front_commande_index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $panier = $session->get('panier', []);
        $articles = [];
        $total = 0;
        $user = $this->getUser();
        $form = $this->createForm(CommandeType::class, null, ['user'=>$user]);

        foreach($panier as $id => $quantite){
            $produit = $produitRepository->find($id);
            $prix = $produit->getPrix();
            if($produit->getDiscount()){
                $prix = $produit->getPrix()-($produit->getPrix()*$produit->getDiscount()/100);
            }
            $articles[] = [
                "produit" => $produit,
                "quantite" => $quantite,
                "prixFixe" => $prix
            ];
            $total += $prix * $quantite;
        }

        return $this->render('front_commande/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
            'total' => $total
        ]);
    }
}
