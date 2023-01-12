<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/clients', name: 'app_clients')]
    public function clients(): Response
    {
        return $this->render('home/clients.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/mon-compte', name: 'app_account')]
    public function account(): Response
    {
        return $this->render('home/account.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
