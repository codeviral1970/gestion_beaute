<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\HistoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoryController extends AbstractController
{
  #[Route('/history', name: 'app_history')]
  public function index(Request $request): Response
  {

    $mes = 'Tu es trop nul';
    $history = new History();

    $historyForm = $this->createForm(HistoryType::class, $history);
    $historyForm->handleRequest($request);
    return $this->render('customer/_history.html.twig', [
      'form' => $historyForm->createView(),
      'mes' => $mes
    ]);
  }
}
