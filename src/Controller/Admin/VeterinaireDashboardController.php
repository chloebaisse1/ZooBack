<?php

namespace App\Controller\Admin;

use App\Entity\ComptesRendusVeto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class VeterinaireDashboardController extends AbstractDashboardController
{
    #[Route('/veterinaire/dashboard', name: 'veterinaire')]
    #[IsGranted('ROLE_USER1')]
    public function index(): Response
    {
        return $this->render('veterinaire/dashboard2.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia Zoo - Veterinaire')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Comptes-rendus', 'fas fa-stethoscope', ComptesRendusVeto::class);
    }
}
