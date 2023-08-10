<?php

namespace App\Controller;

use App\Entity\ContactContent;
use App\Form\ContactContentType;
use App\Repository\ContactContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contact')]
class AdminContactContentController extends AbstractController
{
    #[Route('/', name: 'app_admin_contact_content_index', methods: ['GET'])]
    public function index(ContactContentRepository $contactContentRepository): Response
    {
        return $this->render('admin_contact_content/index.html.twig', [
            'contact_contents' => $contactContentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_contact_content_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactContent = new ContactContent();
        $form = $this->createForm(ContactContentType::class, $contactContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactContent);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contact_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_contact_content/new.html.twig', [
            'contact_content' => $contactContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contact_content_show', methods: ['GET'])]
    public function show(ContactContent $contactContent): Response
    {
        return $this->render('admin_contact_content/show.html.twig', [
            'contact_content' => $contactContent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_contact_content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactContent $contactContent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactContentType::class, $contactContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_contact_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_contact_content/edit.html.twig', [
            'contact_content' => $contactContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_contact_content_delete', methods: ['POST'])]
    public function delete(Request $request, ContactContent $contactContent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactContent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactContent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_contact_content_index', [], Response::HTTP_SEE_OTHER);
    }
}
