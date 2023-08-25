<?php

namespace App\Controller;

use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FrontCommandeController extends AbstractController
{
    #[Route('/commande/create', name: 'app_front_commande_index')]
    public function index(SessionInterface $session): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $form = $this->createForm(CommandeType::class, null, ['user'=>$user]);

        $user = $this->getUser();
        return $this->render('front_commande/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
