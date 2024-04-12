<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/cargos', name: 'cargos')]
    public function cargos(): Response
    {
        return $this->render('pages/cargos.html.twig', []);
    }

    #[Route('/attorneys', name: 'attorney')]
    public function attorneys(): Response
    {
        return $this->render('pages/attorneys.html.twig', []);
    }

    #[Route('/realtors', name: 'realtors')]
    public function realtors(): Response
    {
        return $this->render('pages/realtors.html.twig', []);
    }

    #[Route('/cpas', name: 'cpas')]
    public function cpas(): Response
    {
        return $this->render('pages/cpas.html.twig', []);
    }

    #[Route('/sports', name: 'sports')]
    public function sports(): Response
    {
        return $this->render('pages/sports.html.twig', []);
    }

    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('pages/services.html.twig', []);
    }
}
