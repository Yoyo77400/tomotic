<?php

namespace App\Controller;

use App\Entity\FooterContent;
use App\Form\FooterContentType;
use App\Repository\FooterContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/footer')]
class AdminFooterContentController extends AbstractController
{
    #[Route('/', name: 'app_admin_footer_content_index', methods: ['GET'])]
    public function index(FooterContentRepository $footerContentRepository): Response
    {
        return $this->render('admin_footer_content/index.html.twig', [
            'footer_contents' => $footerContentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_footer_content_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $footerContent = new FooterContent();
        $form = $this->createForm(FooterContentType::class, $footerContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($footerContent);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_footer_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_footer_content/new.html.twig', [
            'footer_content' => $footerContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_footer_content_show', methods: ['GET'])]
    public function show(FooterContent $footerContent): Response
    {
        return $this->render('admin_footer_content/show.html.twig', [
            'footer_content' => $footerContent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_footer_content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FooterContent $footerContent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FooterContentType::class, $footerContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_footer_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_footer_content/edit.html.twig', [
            'footer_content' => $footerContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_footer_content_delete', methods: ['POST'])]
    public function delete(Request $request, FooterContent $footerContent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$footerContent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($footerContent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_footer_content_index', [], Response::HTTP_SEE_OTHER);
    }
}
