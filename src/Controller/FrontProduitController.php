<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_front_produit')]
    public function index(): Response
    {
        return $this->render('front_produit/index.html.twig', [
            'controller_name' => 'FrontProduitController',
        ]);
    }
}
