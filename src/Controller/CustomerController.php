<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\Customers;
use App\Form\HistoryType;
use App\Form\CustomerType;
use App\Entity\SearchCustomer;
use App\Services\FileUploader;
use App\Entity\ImgHistorySlide;
use App\Form\SearchCustomerType;
use App\Form\ImgHistorySlideType;
use App\Repository\HistoryRepository;
use App\Repository\CustomersRepository;
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
    PaginatorInterface $paginator,
    Request $request,
    EntityManagerInterface $em
  ): Response {

    if ($request->isMethod('POST')) {

      $query = $request->get('query');

      $data = $customers->findByQuery($query);
    } else {
      $data = $customers->orderDesc();
    }

    $pagination = $paginator->paginate(
      $data,
      $request->query->getInt('page', 1),
      8
    );
    dump($pagination);
    return $this->render('customer/index.html.twig', [
      'pagination' => $pagination
    ]);
  }

  #[Route('/clients/new', name: 'app_clients_new')]
  public function new(CustomersRepository $customers, Request $request, ManagerRegistry $doctrine): Response
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
    FileUploader $fileUploader,
    $id
  ): Response {

    $history = new History();

    $historyAll = $historyAll->findAll();

    $customer = $customers->find($id);

    //Formulaire pour la modification du client
    $form = $this->createForm(CustomerType::class, $customer);

    //History formulaire pour créer l'historique des soins de l'utilsateur.
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
      return $this->redirectToRoute('app_clients');
    }

    return $this->render('customer/show.html.twig', [
      'customer' => $customer,
      'form' => $form->createView(),
      'historyForm' => $historyForm->createView()
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
