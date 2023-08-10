<?php

namespace App\Controller;

use App\Entity\Contenu;
use App\Form\ContenuType;
use App\Repository\ContenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contenu')]
class AdminContenuController extends AbstractController
{
    #[Route('/', name: 'app_admin_contenu_index', methods: ['GET'])]
    public function index(ContenuRepository $contenuRepository): Response
    {
        return $this->render('admin_contenu/index.html.twig', [
            'contenus' => $contenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_contenu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contenu = new Contenu();
        $form = $this->createForm(ContenuType::class, $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contenu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_contenu/new.html.twig', [
            'contenu' => $contenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contenu_show', methods: ['GET'])]
    public function show(Contenu $contenu): Response
    {
        return $this->render('admin_contenu/show.html.twig', [
            'contenu' => $contenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_contenu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contenu $contenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContenuType::class, $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contenu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_contenu/edit.html.twig', [
            'contenu' => $contenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contenu_delete', methods: ['POST'])]
    public function delete(Request $request, Contenu $contenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contenu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_contenu_index', [], Response::HTTP_SEE_OTHER);
    }
}
