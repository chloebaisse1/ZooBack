<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Form\HoraireType;
use App\Repository\HoraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HoraireController extends AbstractController
{
    #[Route('/horaire', name: 'horaire.index', methods: ['GET'])]
    public function index(HoraireRepository $repository): Response
    {
        return $this->render('pages/horaire/index.html.twig', [
            'horaires' => $repository->findAll()
        ]);
    }
    #[Route('/horaire/creation', name: 'horaire.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $horaire = new Horaire();
        $form = $this->createForm(HoraireType::class, $horaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($horaire);
            $manager->flush();
            $this->addFlash(
                'Success',
                'L\'horaire a été créée avec succès !');

            return $this->redirectToRoute('horaire.index');
        }
        return $this->render('pages/horaire/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('horaire/edition/{id}', name: 'horaire.edit', methods: ['GET', 'POST'])]
    public function edit(Horaire $horaire, Request $request, EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(HoraireType::class, $horaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $horaire = $form->getData();

            $manager->persist($horaire);
            $manager->flush();
            $this->addFlash(
                'success',
                'L\'horaire a été modifiée avec succès !'
            );
            return $this->redirectToRoute('horaire.index');
        }

        return $this->render('pages/horaire/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
    #[Route('/horaire/suppression/{id}', name: 'horaire.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Horaire $horaire): Response
    {
        $manager->remove($horaire);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'horaire a été supprimé avec succès !'
        );

        return $this->redirectToRoute('horaire.index');
    }

}
