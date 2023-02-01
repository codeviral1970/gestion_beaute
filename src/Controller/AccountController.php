<?php

namespace App\Controller;

use App\Entity\ResetPassword;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    #[Route('/mon-compte', name: 'app_account')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $userAccount = $this->getUser();

        // Création du formulaire pour éditer les informations
        $formUserEdit = $this->createForm(UserType::class, $userAccount);
        $formUserEdit->handleRequest($request);

        if ($formUserEdit->isSubmitted() && $formUserEdit->isValid()) {
            $em->persist($userAccount);
            $em->flush();
            $this->addFlash(
                'success',
                'La modification à bien été pris en compte.'
            );

            return $this->redirectToRoute('app_account');
        }

        // Création du formulaire pour changer le mot de passe
        $resetPassword = new ResetPassword();
        $formResetPassword = $this->createForm(ResetPasswordType::class, $resetPassword);
        $formResetPassword->handleRequest($request);

        if ($formResetPassword->isSubmitted() && $formResetPassword->isValid()) {
            if (!password_verify($resetPassword->getOldPassword(), $userAccount->getPassword())) {
                $formResetPassword->get('oldPassword')->addError(new FormError("Le mot de passe n\'est pas identique à oldPassword"));
                $this->addFlash(
                    'warning',
                    'Les mots de passe ne sont pas identique ou votre oldPassword  pas le bon..'
                );
            } else {
                $newPassword = $resetPassword->getNewPassword();
                $hash = $this->hasher->hashPassword($userAccount, $newPassword);

                $userAccount->setPassword($hash);

                $em->persist($userAccount);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Votre mot de passe à bien été modifié.'
                );

                return $this->redirectToRoute('app_account');
            }
        }

        return $this->render('account/index.html.twig', [
          'formResetPassword' => $formResetPassword->createView(),
          'formUserEdit' => $formUserEdit->createView(),
          'userAccount' => $userAccount,
        ]);
    }
}
