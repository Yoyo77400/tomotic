<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\UserType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;

class FrontUserController extends AbstractController
{
    #[Route('/user', name: 'app_front_user')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface, CommandeRepository $commandeRepository): Response
    {
        if(!$this->getUser())
        {
            $this->addFlash('danger', "Vous n'êtes pas autorisé à accédé à cette page. Veuillez d'abbort vous conneter ou vous inscrire");
            return $this->redirectToRoute('app_home');
        }
        
        $user = $this->getUser();
        $commandes = $commandeRepository->findBy(['user' => $user, 'isPaid' => true],['createdAt'=>'DESC']);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $adresses = $request->request->get("user")["adresses"];
            $defaultAdresse = [];
            foreach ($adresses as $key => $adresse) {
                if (array_key_exists('isDefault', $adresse)) {
                        $defaultAdresse[] = $adresse;
                    }
                }
                if (count($defaultAdresse) > 1) {
                    $this->addFlash('danger', "vous ne devez séléctionner qu'une adresse par défaut!");
                    return $this->redirectToRoute('app_front_user');
                }

                if (!is_null($request->request->get('plainpassword'))) {
                    $user->setPassword($userPasswordHasherInterface->hashPassword($user, $request->request->get('plainpassword')));
                    $entityManagerInterface->persist($user);
                }
                $entityManagerInterface->flush();
                $this->addFlash('success', 'Votre profil à bien été mis à jour.');

                return $this->redirectToRoute('app_front_user');
                
        }

        return $this->render('front_user/index.html.twig', [
            'form' => $form->createView(),
            'commandes' => $commandes
        ]);
    }

    #[Route('/generate/pdf/{id}', name: 'app_front_user_generate_pdf')]
    public function generatePDF($id, CommandeRepository $commandeRepository)
    {
        $commande = $commandeRepository->find($id);

        $html = $this->render('front_user/_pdf_commande.html.twig', [
            'commande' => $commande
        ]);
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_get_clean();
        $fichier = $commande->getReference() . '-' . $commande->getUser()->getEmail();
        $dompdf->stream($fichier);
    }
}
