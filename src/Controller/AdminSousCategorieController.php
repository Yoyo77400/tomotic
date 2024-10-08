<?php

namespace App\Controller;

use App\Entity\SousCategorie;
use App\Form\SousCategorieType;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/sous/categorie')]
class AdminSousCategorieController extends AbstractController
{
    #[Route('/', name: 'app_admin_sous_categorie_index', methods: ['GET'])]
    public function index(SousCategorieRepository $sousCategorieRepository): Response
    {
        return $this->render('admin_sous_categorie/index.html.twig', [
            'sous_categories' => $sousCategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_sous_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $sluggerInterface): Response
    {
        $sousCategorie = new SousCategorie();
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousCategorie->setSlug($sluggerInterface->slug(strtolower($sousCategorie->getNom())));
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_sous_categorie/new.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_sous_categorie_show', methods: ['GET'])]
    public function show(SousCategorie $sousCategorie): Response
    {
        return $this->render('admin_sous_categorie/show.html.twig', [
            'sous_categorie' => $sousCategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_sous_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousCategorie $sousCategorie, EntityManagerInterface $entityManager, SluggerInterface $sluggerInterface): Response
    {
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousCategorie->setSlug($sluggerInterface->slug(strtolower($sousCategorie->getNom())));
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_sous_categorie/edit.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_sous_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, SousCategorie $sousCategorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sousCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_sous_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
