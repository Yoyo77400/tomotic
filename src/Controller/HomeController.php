<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use App\Repository\ContactContentRepository;
use App\Repository\ContenuRepository;
use App\Repository\FooterContentRepository;
use App\Repository\HomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function renderReseaux(FooterContentRepository $footerContentRepository): Response
    {
        $reseaux = $footerContentRepository->findBy(['isActive'=>true, 'tag'=>"réseau-sociaux"]);
        return $this->render('front_common/_render_reseaux.html.twig', ['reseaux'=>$reseaux]);
    }
    public function renderPartenaires(FooterContentRepository $footerContentRepository): Response
    {
        $partenaires = $footerContentRepository->findBy(['isActive'=>true, 'tag'=>"partenaires"]);
        return $this->render('front_common/_render_partenaires.html.twig', ['partenaires'=>$partenaires]);
    }
    public function renderContact(ContactContentRepository $contactContentRepository): Response
    {
        $contacts = $contactContentRepository->findBy(['isActive'=>true]);
        return $this->render('front_common/_render_contact.html.twig', ['contacts'=>$contacts]);
    }
    public function renderLogo(HomeRepository $homeRepository): Response
    {
        $logo = $homeRepository->findOneBy(['isActive'=>true]);
        return $this->render('front_common/_render_logo.html.twig', ['logo'=>$logo]);
    }

    public function renderContenuHome(ContenuRepository $contenuRepository): Response
    {
        $aPropos = $contenuRepository->findBy(['isActive'=>true, 'tag'=>"a-propos-de-nous"]);
        $solutionsHome = $contenuRepository->findBy(['isActive'=>true, 'tag'=>"solutions-du-site"]);

        return $this->render('front_common/_contenu_home.html.twig', [
            'aPropos' => $aPropos,
            'solutionsHome' => $solutionsHome
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function index(HomeRepository $homeRepository, CarouselRepository $carouselRepository, ContenuRepository $contenuRepository): Response
    {
        $aPropos = $contenuRepository->findBy(['isActive'=>true, 'tag'=>"a-propos-de-nous"]);
        $solutionsHome = $contenuRepository->findBy(['isActive'=>true, 'tag'=>"solutions-du-site"]);
        $carousels = $carouselRepository->findBy(["isActive"=>true, "tag"=>"home"],["rankNumber"=>"ASC"]);
        return $this->render('home/index.html.twig', [
            'home' => $homeRepository->findOneBy(['isActive'=>true]),
            'carousels' => $carousels,
            'aPropos' => $aPropos,
            'solutionsHome' => $solutionsHome
        ]);
    }
}
