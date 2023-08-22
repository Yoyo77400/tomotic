<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontProduitController extends AbstractController
{
    #[Route('/produit/{slug}', name: 'app_front_produit')]
    public function index($slug, ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findOneBy(['slug'=>$slug]);
        return $this->render('front_produit/index.html.twig', [
            'produit' => $produit,
        ]);
    }
}
