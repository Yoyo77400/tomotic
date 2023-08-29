<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(ProduitRepository $produitRepository, CommandeRepository $commandeRepository): Response
    {
        return $this->render('admin_dashboard/index.html.twig', [
            'produits' =>$produitRepository->findAll(),
            'commandes' => $commandeRepository->findAll(),
        ]);
    }
}
