<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('security.login');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form ->getData()->getPlainPassword()))
                $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Les informations de votre compte ont bien été modifiées.'
            );

            return $this->redirectToRoute('service.index');
        } else {
            $this->addFlash(
                'warning',
                'Le mot de passe renseigné est incorrect.'
            );
        }
        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/utilisateur/edition-mot-de-passe/{id}', name: 'user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher) : Response
    {
       $form = $this->createForm(UserPasswordType::class);

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           if ($hasher->isPasswordValid($user, $form->getData()['plainPassword']))
           { $user->setPassword(
               $hasher->hashPassword(
                   $user,
                   $form->getData()['newPassword']
               )
           );
               $this->addFlash(
                   'Success',
                   'Le mot de passe a été modifié.'
               );

               $manager->persist($user);
               $manager->flush();


               return $this->redirectToRoute('security.login');
           } else {
               $this->addFlash(
                   'warning',
                   'Le mot de passe renseigné est incorrect.'
               );
           }
       }

      return $this->render('pages/user/edit_password.html.twig', [
          'form' => $form->createView(),
      ]);
}

}