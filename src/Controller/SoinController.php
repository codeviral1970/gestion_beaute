<?php

namespace App\Controller;

use App\Entity\Soin;
use App\Form\SoinType;
use App\Repository\SoinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SoinController extends AbstractController
{
    #[Route('/soin', name: 'app_soin')]
    public function index(SoinRepository $soinRepo): Response
    {

        $soins = $soinRepo->findAll();
        return $this->render('soin/index.html.twig', [
            'soins' => $soins
        ]);
    }

    #[Route('/soin/nouveau', name: 'app_soin_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $soin = new Soin();

        $form = $this->createForm(SoinType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            
            $em->persist($soin);
            $em->flush();

            return $this->redirectToRoute('app_soin');
        }

        return $this->render('soin/new.html.twig', [
            'form' => $form->createView()
        ]);

        return $this->render('soin/new.html.twig', [
           'form' => $form->createView()
        ]);
    }

    #[Route('/soin/edit/{id}', name: 'app_soin_edit', methods:'GET|POST')]
    public function edit(
        Request $request, 
        EntityManagerInterface $em,
        Soin $soinEdit
        ): Response
    {

        $form = $this->createForm(SoinType::class, $soinEdit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($soinEdit);
            $em->flush();

            return $this->redirectToRoute('app_soin');
        }

        return $this->render('soin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/soin/delete/{id}', name: 'app_soin_delete')]
    public function delete(
        Request $request, 
        EntityManagerInterface $em,
        Soin $soin
        ): Response
    {
        $em->remove($soin);
        $em->flush();

        //return new Response("L'événement {$soin->getId()} à bien été supprimer.");

        return $this->redirectToRoute('app_soin');
    }
}

