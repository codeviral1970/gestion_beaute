<?php

namespace App\Controller;

use App\Repository\CustomersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(CustomersRepository $customers): Response
    {
        return $this->render('home/index.html.twig', [
            'customers' => $customers->findAll(),
        ]);
    }
}
