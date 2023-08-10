<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontCategorieController extends AbstractController
{

    public function renderCategorieDropdown(CategorieRepository $categorieRepository, SousCategorieRepository $sousCategorieRepository): Response
    {
        $categories = $categorieRepository->findBy(['isActive'=>true]);
        return $this->render('front_categorie/_categorie_dropdown.html.twig', ['categories'=>$categories]);
    }
    public function renderCategorieMenu(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findBy(['isActive'=>true]);
        return $this->render('front_categorie/_categorie_menu_card.html.twig', ['categories'=>$categories]);
    }

    #[Route('/categorie/{slug}', name: 'app_front_categorie')]
    public function index($slug, CategorieRepository $categorieRepository): Response
    {
        if($slug == "categories"){
            return $this->render('front_categorie/index.html.twig', [
                'categories' => $categorieRepository->findBy(['isActive'=>true], ["nom"=>'ASC']),
            ]);
        }else{
            $categorie = $categorieRepository->findOneBy(['slug'=>$slug]);
            return $this->render('front_categorie/show_categorie.html.twig', [
                'categorie' => $categorie,
            ]);
        }
    }
}
