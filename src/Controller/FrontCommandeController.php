<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FrontCommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_front_commande_index')]
    public function index(SessionInterface $session): Response
    {
        return $this->render('front_commande/index.html.twig', [
            'controller_name' => 'FrontCommandeController',
        ]);
    }
}
