<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Entity\SearchCustomer;
use App\Form\SearchCustomerType;
use App\Repository\CustomersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchCustomerController extends AbstractController
{
  public function __construct(private CustomersRepository $customerRepo)
  {
  }

  #[Route('/navSearch', name: 'app_nav_search')]
  public function index(Request $request): Response
  {
    $test = "test controller dans une nav";
    $searchCustomer = new SearchCustomer();

    $customerSearch = [];

    $formSearch = $this->createForm(SearchCustomerType::class, $searchCustomer);
    $formSearch->handleRequest($request);

    if ($formSearch->isSubmitted() && $formSearch->isValid()) {
      $firstName = $searchCustomer->getNom();

      if ($firstName !== "") {
        $customerSearch = $this->customerRepo->findOneBy(['fistName' => $firstName]);
        dd($customerSearch);
      } else {
        $customerSearch = $this->customerRepo->findAll();
      }
    }

    return $this->render('components/_searchBar.html.twig', [
      'formSearch' => $formSearch->createView(),
      'customerSearch' => $customerSearch,
      'test' => $test
    ]);
  }
}
