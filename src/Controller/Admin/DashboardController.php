<?php

namespace App\Controller\Admin;

use App\Entity\ComptesRendusVeto;
use App\Entity\Contact;
use App\Entity\Habitat;
use App\Entity\Horaire;
use App\Entity\PassageEmploye;
use App\Entity\Service;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin/dashboard', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia Zoo - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Demandes de contact', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-sun', Service::class);
        yield MenuItem::linkToCrud('Habitats', 'fas fa-paw', Habitat::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', Horaire::class);
        yield MenuItem::linkToCrud('Comptes-rendus', 'fas fa-stethoscope', ComptesRendusVeto::class);
        yield MenuItem::linkToCrud('Passage Employé', 'fas fa-calendar-days', PassageEmploye::class);
    }
}
