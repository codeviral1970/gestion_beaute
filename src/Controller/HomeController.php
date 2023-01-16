<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomerType;
use App\Repository\CustomersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(CustomersRepository $customers): Response
    {
        
        return $this->render('home/index.html.twig', [
            'customers' => $customers->findAll(),
        ]);
    }
    
    #[Route('/clients', name: 'app_clients')]
    public function all(
        CustomersRepository $customers,
        PaginatorInterface $paginator, 
        Request $request
        ): Response
    {
        $data = $customers->findAll();
        $pagination = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1), /*page number*/
            10
        );
        
        return $this->render('home/clients.html.twig', [
            'pagination' => $pagination
        ]);
    }
                
    #[Route('/clients/nouveau', name: 'app_new')]
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
        
    #[Route('/clients/edit/{id}', name: 'app_edit')]
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
        
    #[Route('/clients/{id}', name: 'app_show')]
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
