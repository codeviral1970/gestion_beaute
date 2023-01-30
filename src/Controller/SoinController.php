<?php

namespace App\Controller;

use App\Entity\Soin;
use App\Form\SoinType;
use App\Repository\SoinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SoinController extends AbstractController
{
    #[Route('/soin', name: 'app_soin')]
    public function index(Soin $soin): Response
    {
        return $this->render('soin/index.html.twig', [
            'controller_name' => 'SoinController',
        ]);
    }

    #[Route('/soin/creation', name: 'app_soin_new')]
    public function new(
        Request $request, 
        SoinRepository $soinRepo,
        EntityManagerInterface $em
        ): Response
    {
        $soin = new Soin();

        $formSoin = $this->createForm(SoinType::class, $soin);
        $formSoin->handleRequest($request);

        if ($formSoin->isSubmitted() && $formSoin->isValid())
        {
            //dd($soin);
            $em->persist($formSoin);
            $em->flush();

            return $this->redirectToRoute('app_soin_new');
        }

        return $this->render('soin/new.html.twig', [
            'formSoin' => $formSoin->createView()
        ]);
    }
}
