<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ImageController extends AbstractController
{
    #[Route('/image', name: 'app_image')]
    public function index(ImageRepository $imageRepo): Response
    {
        return $this->render('image/index.html.twig', [
          'image' => $imageRepo->findAll(),
        ]);
    }

    #[Route('/image/edit/{id}', name: 'app_image_edit')]
    public function edit(
    Request $request,
    EntityManagerInterface $em,
    Image $image
  ): Response {
        // $serializer = new Serializer([new ObjectNormalizer()]);

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $serializer->normalize($image, null, [AbstractNormalizer::ATTRIBUTES => ['imageName']]);
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('app_image');
        }

        return $this->render('image/edit.html.twig', [
          'form' => $form->createView(),
        ]);
    }

    #[Route('/image/new', name: 'app_image_new')]
    public function new(
    Request $request,
    EntityManagerInterface $em,
    ImageRepository $image
  ): Response {
        $image = new Image();
        $serializer = new Serializer([new ObjectNormalizer()]);

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $serializer->normalize($image, null, [AbstractNormalizer::ATTRIBUTES => ['imageName']]);
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('app_image');
        }

        return $this->render('image/new.html.twig', [
          'form' => $form->createView(),
        ]);
    }
}
