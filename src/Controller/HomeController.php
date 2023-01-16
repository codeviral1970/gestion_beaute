<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomerType;
use App\Repository\CustomersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/clients')]
class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function dashboard(CustomersRepository $customers): Response
  {
    
    $customers = $customers->findAll();

    return $this->render('home/index.html.twig', [
      'customers' => $customers
    ]);
  }

  #[Route('/liste-des-clients', name: 'app_all_client')]
  public function all(CustomersRepository $customers): Response
  {
    $customers = $customers->findAll();

    return $this->render('home/clients.html.twig', [
      'customers' => $customers
    ]);
  }

  #[Route('/mon-compte-deux', name: 'app_account_deux')]
  public function account(): Response
  {
    return $this->render('home/account.html.twig', [
      'controller_name' => 'HomeController',
    ]);
  }

  #[Route('/new', name: 'app_new')]
  public function new(CustomersRepository $customers, Request $request, ManagerRegistry $doctrine): Response
  {
    $entityManager = $doctrine->getManager();
    
    $customers = new Customers();

    $form = $this->createForm(CustomerType::class, $customers);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $entityManager->persist($customers);
        $entityManager->flush();

            return $this->redirectToRoute('app_all_client');
    }

    return $this->render('home/new.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/edit/{id}', name: 'app_edit')]
  public function edit(CustomersRepository $customers, $id, Request $request, ManagerRegistry $doctrine): Response
  { 
    $entityManager = $doctrine->getManager();

    $form = $this->createForm(CustomerType::class, $customers);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $entityManager->persist($customers);
        $entityManager->flush();

        return $this->redirectToRoute('app_all_client');
    }
    
    return $this->render('home/show.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/{id}', name: 'app_show')]
  public function show(CustomersRepository $customers, $id, ManagerRegistry $doctrine, Request $request): Response
  { 

    $entityManager = $doctrine->getManager();

    $customer = $customers->find($id);

    $entityManager = $doctrine->getManager();

    $form = $this->createForm(CustomerType::class, $customer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $entityManager->persist($customer);
        $entityManager->flush();

        return $this->redirectToRoute('app_all_client');
    }
    
    return $this->render('home/show.html.twig', [
      'customer' => $customer,
      'form' => $form->createView()
    ]);
  }
}
