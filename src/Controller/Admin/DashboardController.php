<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController
        (RoomCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('3MONKIES');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Escape Rooms', 'fa fa-building')
          ->setSubItems([
            MenuItem::linkToCrud('Room', 'fa fa-home',
              RoomCrudController::getEntityFqcn()),
            MenuItem::linkToCrud('Difficulty', 'fa fa-line-chart',
              DifficultyCrudController::getEntityFqcn()),
            MenuItem::linkToCrud('Default Tips', 'fa fa-question',
              TipCrudController::getEntityFqcn()),
          ]);
        yield MenuItem::linkToCrud('Users', 'fa fa-user',
          UserCrudController::getEntityFqcn());



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
