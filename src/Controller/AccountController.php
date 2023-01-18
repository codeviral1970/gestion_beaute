<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdatePasswordType;
use App\Form\UserType;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/mon-compte', name: 'app_account')]
    public function index(Request $request): Response
    {
        $userAccount = $this->getUser();

        // dd($userAccount);
        return $this->render('account/index.html.twig', [
            'userAccount' => $userAccount,
        ]);
    }

    #[route('/mon-compte/edition/{id}', name: 'app_account_edit')]
    public function edit(
        Request $request,
        EntityManagerInterface $em,
        FileUploader $fileUploader,
        User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reset-password/{id}', name: 'app_reset_password')]
    public function updatePassword(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher,
        User $user)
    {
        // $updatePasswordForm = $this->createForm(UpdatePasswordType::class);
        // $updatePasswordForm->handleRequest($request);

        // if($updatePasswordForm->isSubmitted() && $updatePasswordForm->isValid())
        // {
        //     if($hasher->isPasswordValid($user, $updatePasswordForm->getData()['plainPassword'] ))
        //     {
        //         $user->setUpdatedAt(new \DateTimeImmutable());
        //         $user->setPlainPassword(
        //             $updatePasswordForm->getData()['newPassword'],
        //         );

        //         $em->persist($user);
        //         $em->flush();
        //        // dd($user);

        //         $this->addFlash(
        //             'success',
        //             'Les informations de votre compte ont bien été modifiées.'
        //         );

        //         return $this->redirectToRoute('app_account');
        //     } else {
        //         $this->addFlash(
        //             'warning',
        //             'Le mot de passe renseigné est incorrect.'
        //         );
        //     }

        //     return $this->redirectToRoute('app_home');
        // }

        // return $this->render('account/resetPassword.html.twig', [
        //     'updatePasswordForm' => $updatePasswordForm->createView()
        // ]);
    }
}
