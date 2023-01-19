<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomerType;
use App\Repository\CustomersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/clients', name: 'app_clients')]
    public function all(
        CustomersRepository $customers,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
        $data = $customers->findAll();
        $pagination = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1), /* page number */
            8
        );

        return $this->render('customer/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/clients/nouveau', name: 'app_clients_new')]
    public function new(CustomersRepository $customers, Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $customers = new Customers();

        $form = $this->createForm(CustomerType::class, $customers);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customers);
            $entityManager->flush();

            return $this->redirectToRoute('app_clients');
        }

        return $this->render('customer/new.html.twig', [
            'form' => $form->createView(),
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

    #[Route('/clients/{id}', name: 'app_client_show')]
    public function show(
        CustomersRepository $customers,
        ManagerRegistry $doctrine,
        Request $request,
        $id
        ): Response {
        $entityManager = $doctrine->getManager();

        $customer = $customers->find($id);

        $entityManager = $doctrine->getManager();

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('app_clients');
        }

        return $this->render('customer/show.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }
}
