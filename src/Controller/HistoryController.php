<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\ImgHistorySlide;
use App\Form\HistoryType;
use App\Repository\HistoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HistoryController extends AbstractController
{
  #[Route('/history', name: 'app_history')]
  public function index(Request $request): Response
  {


    return $this->render('cutomer/_history.html.twig', []);
  }

  #[Route('/history/show/{id}', name: 'app_history_show')]
  public function show(Request $request, HistoryRepository $histoRepo, $id): Response
  {
    $historyRepo = $histoRepo->find($id);
    //dd($histoRepo);

    return $this->render('history/show.html.twig', [
      'historyRepo' => $historyRepo

    ]);
    //return $this->render('history/show.html.twig', []);

    //return new JsonResponse($histoRepo);
  }
}
