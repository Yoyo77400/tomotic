<?php

namespace App\Controller;

use App\Repository\SousCategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontSousCategorieController extends AbstractController
{
    #[Route('/sous/categorie/{slug}', name: 'app_front_sous_categorie')]
    public function index($slug, SousCategorieRepository $sousCategorieRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $sousCategorie = $sousCategorieRepository->findOneBy(['slug'=>$slug]);
        $produits = $sousCategorie->getProduits();
        $produits = $paginator->paginate(
            $produits, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15, /*limit per page*/
        );
        return $this->render('front_sous_categorie/index.html.twig', [
            'sousCategorie' => $sousCategorie,
            'produits' => $produits,
        ]);
    }
}
