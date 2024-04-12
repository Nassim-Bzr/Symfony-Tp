<?php

namespace App\Controller;



use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{

    #[Route('/', name: 'default_home', methods: ['GET'])]
    public function home(AnnoncesRepository $annoncesRepository): Response
    {
        #1. Récupération des derniers articles
        $annonces = $annoncesRepository->findAll();

        #2. Passer a la vue les informations reçues
        return $this->render('default/home.html.twig', [
            'annonces' => $annonces
        ]);
    }

    #[Route('/annonce/{id}', name: 'annonce_details')]
    public function details(int $id, AnnoncesRepository $annoncesRepository): Response
    {
        $annonce = $annoncesRepository->find($id);

        if (!$annonce) {
            throw $this->createNotFoundException('L\'annonce demandée n\'existe pas.');
        }

        return $this->render('annonce/details.html.twig', [
            'annonce' => $annonce
        ]);
    }

    /**
     * CONSIGNE : Créée la route permet d'afficher un article.
     * ex. https://localhost:8000/categorie/alias
     */

}
