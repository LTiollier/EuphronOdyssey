<?php

namespace App\Controller\Admin;

use App\Entity\Exercise;
use App\Entity\Program;
use App\Entity\SubProgram;
use App\Entity\Training;
use App\Entity\TrainingSerie;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EuphronOdyssey');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Programmes', 'fas fa-list', Program::class);
        yield MenuItem::linkToCrud('Sous-Programmes', 'fas fa-list', SubProgram::class);
        yield MenuItem::linkToCrud('Exercices', 'fas fa-list', Exercise::class);
        yield MenuItem::linkToCrud('Entrainements', 'fas fa-list', Training::class);
        yield MenuItem::linkToCrud("Séries d'entrainements", 'fas fa-list', TrainingSerie::class);
    }
}
