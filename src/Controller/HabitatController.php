<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Form\HabitatType;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'habitat.index', methods:['GET'])]
    public function index(HabitatRepository $repository, Request $request): Response
    {
        return $this->render('pages/habitat/index.html.twig', [
            'habitats' => $repository->findAll()
        ]);
    }
    #[Route('/habitat/creation', name: 'habitat.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $habitat = new Habitat();
        $form = $this->createForm(HabitatType::class, $habitat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $habitat = $form->getData();

            $manager->persist($habitat);
            $manager->flush();
            $this->addFlash(
                'Success',
                'L\'habitat a été crée avec succès !');

            return $this->redirectToRoute('habitat.index');
        }
        return $this->render('pages/habitat/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('habitat/edition/{id}', name: 'habitat.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Habitat $habitat, Request $request, EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $habitat = $form->getData();

            $manager->persist($habitat);
            $manager->flush();
            $this->addFlash(
                'success',
                '\'habitat a été modifié avec succès !'
            );
            return $this->redirectToRoute('habitat.index');
        }

        return $this->render('pages/habitat/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
    #[Route('/habitat/suppression/{id}', name: 'habitat.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(EntityManagerInterface $manager, Habitat $habitat): Response
    {
        if(!$habitat){
            $this->addFlash(
                'success',
                'l\'habitat n\'existe pas !'
            );

            return $this->redirectToRoute('habitat.index');
        }
        $manager->remove($habitat);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'habitat a été supprimé avec succès !'
        );

        return $this->redirectToRoute('habitat.index');
    }

}
