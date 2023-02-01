<?php

namespace App\Controller;

use App\Repository\CustomersRepository;
use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(
    CustomersRepository $customers,
    HistoryRepository $history
  ): Response {
        $admin = $this->getUser();
        $history = $history->findLastFiveHistory();

        return $this->render('home/index.html.twig', [
          'customers' => $customers->countCustomers(),
          'admin' => $admin,
          'history' => $history,
        ]);
    }
}
