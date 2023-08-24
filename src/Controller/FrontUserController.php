<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class FrontUserController extends AbstractController
{
    #[Route('/user', name: 'app_front_user')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface, AdresseRepository $adresseRepository): Response
    {
        $user = $this->getUser();
        // $comparaison = new Comparison('isDefault', '=', 'true');
        // $critere = new Criteria();
        // $critere->where($comparaison);
        // dd($user->getAdresses()->matching($critere));
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!is_null($request->request->get('plainpassword'))){
                $user->setPassword($userPasswordHasherInterface->hashPassword($user, $request->request->get('plainpassword')));
                $entityManagerInterface->persist($user);
            }
        $entityManagerInterface->flush();
        $this->addFlash('success', 'Votre profil à bien été mis à jour.');

        return $this->redirectToRoute('app_front_user');
        }

        return $this->render('front_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
