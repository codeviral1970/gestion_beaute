<?php

namespace App\Controller;

use App\Repository\CustomersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/clients', name: 'app_clients')]
    public function clients(CustomersRepository $customers): Response
    {
        $customers = $customers->findAll();

        return $this->render('home/clients.html.twig', [
            'customers' => $customers
        ]);
    }

    #[Route('/clients/{id}', name: 'app_client_show')]
    public function clientShow(CustomersRepository $customers, $id): Response
    {
        $customer = $customers->findOneBy(['id' => $id]);

        return $this->render('home/client.show.html.twig', [
            'customer' => $customer
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
