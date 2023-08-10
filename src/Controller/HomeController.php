<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use App\Repository\ContactContentRepository;
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

    #[Route('/', name: 'app_home')]
    public function index(HomeRepository $homeRepository, CarouselRepository $carouselRepository): Response
    {
        $carousels = $carouselRepository->findBy(["isActive"=>true, "tag"=>"home"],["rankNumber"=>"ASC"]);
        return $this->render('home/index.html.twig', [
            'home' => $homeRepository->findOneBy(['isActive'=>true]),
            'carousels' => $carousels
        ]);
    }
}
