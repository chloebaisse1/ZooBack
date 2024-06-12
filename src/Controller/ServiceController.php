<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'service.index', methods: ['GET'])]
    public function index(ServiceRepository $repository, Request $request): Response
    {
        return $this->render('pages/service/index.html.twig', [
        'services' => $repository->findAll()
        ]);
    }
    #[Route('/service/creation', name: 'service.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $manager->persist($service);
            $manager->flush();
            $this->addFlash(
                'Success',
                'Le service a été crée avec succès !');

            return $this->redirectToRoute('service.index');
        }
        return $this->render('pages/service/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('service/edition/{id}', name: 'service.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN', 'ROLE_USER1')]
    public function edit(Service $service, Request $request, EntityManagerInterface $manager) : Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $manager->persist($service);
            $manager->flush();
            $this->addFlash(
                'success',
                'Le service a été modifié avec succès !'
            );
            return $this->redirectToRoute('service.index');
        }

        return $this->render('pages/service/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
    #[Route('/service/suppression/{id}', name: 'service.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(EntityManagerInterface $manager, Service $service): Response
    {
        if(!$service){
            $this->addFlash(
                'success',
                'le service n\'existe pas !'
            );

            return $this->redirectToRoute('service.index');
        }
        $manager->remove($service);
        $manager->flush();

        $this->addFlash(
            'success',
            'Le service a été supprimé avec succès !'
        );

        return $this->redirectToRoute('service.index');
    }
}
