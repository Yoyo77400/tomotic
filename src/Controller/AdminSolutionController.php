<?php

namespace App\Controller;

use App\Entity\Solution;
use App\Form\SolutionType;
use App\Repository\SolutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/solution')]
class AdminSolutionController extends AbstractController
{
    #[Route('/', name: 'app_admin_solution_index', methods: ['GET'])]
    public function index(SolutionRepository $solutionRepository): Response
    {
        return $this->render('admin_solution/index.html.twig', [
            'solutions' => $solutionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_solution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $solution = new Solution();
        $form = $this->createForm(SolutionType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($solution);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_solution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_solution/new.html.twig', [
            'solution' => $solution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_solution_show', methods: ['GET'])]
    public function show(Solution $solution): Response
    {
        return $this->render('admin_solution/show.html.twig', [
            'solution' => $solution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_solution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Solution $solution, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SolutionType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_solution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_solution/edit.html.twig', [
            'solution' => $solution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_solution_delete', methods: ['POST'])]
    public function delete(Request $request, Solution $solution, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solution->getId(), $request->request->get('_token'))) {
            $entityManager->remove($solution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_solution_index', [], Response::HTTP_SEE_OTHER);
    }
}
