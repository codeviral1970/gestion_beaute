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

}
