<?php

namespace App\Controller;

use Stripe\Stripe;
use DateTimeImmutable;
use App\Entity\Article;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FrontCommandeController extends AbstractController
{
    #[Route('/commande/create', name: 'app_front_commande_index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $panier = $session->get('panier', []);
        $articles = [];
        $total = 0;
        $user = $this->getUser();
        $form = $this->createForm(CommandeType::class, null, ['user' => $user]);

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            $prix = $produit->getPrix();
            if ($produit->getDiscount()) {
                $prix = $produit->getPrix() - ($produit->getPrix() * $produit->getDiscount() / 100);
            }
            $articles[] = [
                "produit" => $produit,
                "quantite" => $quantite,
                "prixFixe" => $prix
            ];
            $total += $prix * $quantite;
        }

        return $this->render('front_commande/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
            'total' => $total
        ]);
    }

    #[Route('/commande/verify', name: 'app_front_commande_verify')]
    public function verify(SessionInterface $session, ProduitRepository $produitRepository, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $panier = $session->get('panier');
        $total = 0;

        $user = $this->getUser();
        $dateTime = new DateTimeImmutable('now');
        $reference = $dateTime->format('dmY') . '-' . uniqid();
        $form = $this->createForm(CommandeType::class, null, ['user' => $user]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = new Commande();
            $adresse = $form->getData()['adresse'];
            $total = 0;

            foreach ($panier as $id => $quantite) {
                $produit = $produitRepository->find($id);
                $prix = $produit->getPrix();
                if ($produit->getDiscount()) {
                    $prix = $produit->getPrix() - ($produit->getPrix() * $produit->getDiscount() / 100);
                }

                $article = new Article();
                $article->setProduit($produit);
                $article->setQuantite($quantite);
                $article->setPrixFixe($prix);

                $entityManagerInterface->persist($article);

                $commande->addArticle($article);

                $total += $prix * $quantite;
            }

            $commande->setReference($reference);
            $commande->setAdresse($adresse);
            $commande->setUser($user);
            $commande->setCreatedAt($dateTime);
            $commande->setPrixTotal($total);
            $commande->setIsPaid(false);

            $entityManagerInterface->persist($commande);
            $entityManagerInterface->flush();


            return $this->render('front_commande/verify.html.twig', [
                'commande' => $commande,
            ]);
        }
        return $this->render('front_user/index.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/commande/create-session-stripe/{reference}', name: 'payment_stripe')]
    public function paymentStripe(EntityManagerInterface $entityManager, CommandeRepository $commandeRepository, $reference, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        $commande = $commandeRepository->findOneBy(['reference' => $reference]);

        if(!$commande){
            return $this->redirectToRoute("app_panier_index");
        }

        $articlesStripe = [];
        foreach($commande->getArticles() as $article){
            $articlesStripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount'=> $article->getPrixFixe() * 100,
                    'product_data' => [
                        'name'=> $article->getProduit()->getNom()
                    ]
                ],
                'quantity' => $article->getQuantite()
            ];
        }

        Stripe::setApiKey('sk_test_51NjSrqAqwXIzP1QuVYz1Vc3Heq9HoQQBResKZ6akLqXtnlTL5LrqhQoUJLj2Dv8hVuahgD9u9RVs9wPibs0UfXdW006fmpGQK2');

        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $commande->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [[
                $articlesStripe
            ]],
            'mode' => 'payment',
            'success_url' => $urlGenerator->generate("payment_success", [
                'reference' => $commande->getReference()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $urlGenerator->generate("payment_error", [
                'reference' => $commande->getReference()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return new RedirectResponse($checkout_session->url);
    }

    #[Route('/commande/success/{reference}', name: 'payment_success')]
    public function paymentSuccess($reference, EntityManagerInterface $entityManager, CommandeRepository $commandeRepository, SessionInterface $session)
    {
        $session->remove('panier');
        $commande = $commandeRepository->findOneBy(['reference' => $reference]);
        $commande->setIsPaid('true');
        $entityManager->persist($commande);
        $entityManager->flush();

        $this->addFlash('success', 'Votre paiement a été effectué avec succès! Un email récapitulatif vous a été envoyé. Le détail de votre commande est également accessible depuis votre compte utilisateur.');
        
        return $this->redirectToRoute('app_home');
    }

    #[Route('/commande/error/{reference}', name: 'payment_error')]
    public function paymentError($reference, CommandeRepository $commandeRepository, EntityManagerInterface $entityManager)
    {
        $commande = $commandeRepository->findOneBy(['reference' => $reference]);
        $entityManager->remove($commande);
        $this->addFlash('error', 'Votre paiement n\'a pas aboutit! Merci de réessayer de passer votre commande plus tard');
        return $this->redirectToRoute('app_panier_index');
    }
}
