<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ImageRepository;
use App\Repository\ServicesRepository;
use App\Repository\CustomersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
  #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format' => 'xml'])]
  public function index(
    Request $request,
    CustomersRepository $customersRepository,
    ImageRepository $imageRepository
  ): Response {
    $hostName = $request->getSchemeAndHttpHost();

    $urls = [];
    $urls[] = ['loc' => $this->generateUrl('app_account')];
    $urls[] = ['loc' => $this->generateUrl('app_clients')];
    $urls[] = ['loc' => $this->generateUrl('app_dashboard')];
    $urls[] = ['loc' => $this->generateUrl('app_image')];
    $urls[] = ['loc' => $this->generateUrl('app_history')];

    foreach ($customersRepository->findAll() as $customers) {
      $urls[] = [
        'loc' => $this->generateUrl('app_client_show', [
          'id' => $customers->getId(),
        ])
      ];
    }

    $response = new Response(
      $this->renderView('sitemap/index.html.twig', [
        'hostName' => $hostName,
        'urls' => $urls
      ]),
      200
    );

    $response->headers->set('Content-type', 'text/xml');

    return ($response);
  }
}
