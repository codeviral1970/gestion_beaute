<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\Customers;
use App\Form\HistoryType;
use App\Form\CustomerType;
use App\Repository\CustomersRepository;
use App\Repository\HistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{
  #[Route('/clients', name: 'app_clients')]
  public function all(
    CustomersRepository $customers,
    Request $request
  ): Response {
    // $data = $customers->findAll();
    // $pagination = $paginator->paginate(
    //     $data,
    //     $request->query->getInt('page', 1), /* page number */
    //     8
    // );

    return $this->render('customer/index.html.twig', [
      // 'pagination' => $pagination,
    ]);
  }

  #[Route('/clients/new', name: 'app_clients_new')]
  public function new(CustomersRepository $customers, SoinRepository $soin, Request $request, ManagerRegistry $doctrine): Response
  {
    $entityManager = $doctrine->getManager();

    $customers = new Customers();

    $form = $this->createForm(CustomerType::class, $customers);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      //$soin = $customers->addSoin();
      // foreach ($customers->getSoin() as $soin) {
      //   $soin->addCustomer($customers);
      //   $entityManager->persist($soin);
      // }
      $entityManager->persist($customers);
      $entityManager->flush();

      return $this->redirectToRoute('app_clients');
    }

    return $this->render('customer/new.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  #[Route('/clients/show/{id}', name: 'app_client_show')]
  public function show(
    CustomersRepository $customers,
    EntityManagerInterface $em,
    Request $request,
    HistoryRepository $historyAll,
    $id
  ): Response {

    $history = new History();
    $historyAll = $historyAll->findAll();
    $customer = $customers->find($id);

    $form = $this->createForm(CustomerType::class, $customer);
    $historyForm = $this->createForm(HistoryType::class, $history);
    $form->handleRequest($request);
    $historyForm->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($customer);
      $em->flush();
      return $this->redirectToRoute('app_clients');
    }

    if ($historyForm->isSubmitted() && $historyForm->isValid()) {
      $historySoin = $history->addCustomer($customer);
      $em->persist($historySoin);
      $em->flush();
      return $this->redirectToRoute('app_client_show');
    }

    return $this->render('customer/show.html.twig', [
      'customer' => $customer,
      'form' => $form->createView(),
      'historyForm' => $historyForm->createView(),
      'historyAll' => $historyAll
    ]);
  }

  #[Route('/clients/edit/{id}', name: 'app_client_edit')]
  public function edit(CustomersRepository $customers, $id, Request $request, ManagerRegistry $doctrine): Response
  {
    $entityManager = $doctrine->getManager();

    $form = $this->createForm(CustomerType::class, $customers);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->persist($customers);
      $entityManager->flush();

      return $this->redirectToRoute('app_clients');
    }

    return $this->render('customer/show.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
