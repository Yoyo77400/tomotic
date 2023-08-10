<?php

namespace App\Controller;

use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontSousCategorieController extends AbstractController
{
    #[Route('/sous/categorie/{slug}', name: 'app_front_sous_categorie')]
    public function index($slug, SousCategorieRepository $sousCategorieRepository): Response
    {
        $sousCategorie = $sousCategorieRepository->findOneBy(['slug'=>$slug]);
        return $this->render('front_sous_categorie/index.html.twig', [
            'sousCategorie' => $sousCategorie,
        ]);
    }
}
