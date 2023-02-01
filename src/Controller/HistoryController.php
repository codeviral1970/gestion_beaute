<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractController
{
    #[Route('/history', name: 'app_history')]
    public function index(Request $request): Response
    {
        return $this->render('cutomer/_history.html.twig', []);
    }

    #[Route('/history/show/{id}', name: 'app_history_show')]
    public function show(Request $request, HistoryRepository $history, $id): Response
    {
        $history = $history->find($id);

        return $this->render('history/show.html.twig', [
          'history' => $history,
        ]);
    }
}
