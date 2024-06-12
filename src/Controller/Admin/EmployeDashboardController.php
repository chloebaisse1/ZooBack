<?php

namespace App\Controller\Admin;

use App\Entity\PassageEmploye;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EmployeDashboardController extends AbstractDashboardController
{
    #[Route('/employe/dashboard', name: 'employe')]
    #[IsGranted("ROLE_USER2")]
    public function index(): Response
    {
        return $this->render('employe/dashboard1.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia Zoo - Employe')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Services', 'fas fa-sun', Service::class);
        yield MenuItem::linkToCrud('Passage Employé', 'fas fa-calendar-days', PassageEmploye::class);
    }
}
