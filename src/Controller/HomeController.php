<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomerType;
use App\Repository\CustomersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_home')]
    public function dashboard(): Response
    {
        return $this->render('home/index.html.twig', [
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
