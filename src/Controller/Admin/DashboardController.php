<?php

namespace App\Controller\Admin;

use App\services\DbManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController {

    private $dbManager;

    public function __construct(DbManager $dbManager) {
        $this->dbManager = $dbManager;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response {

        $allGames = $this->dbManager->getSQL("select * from game where active=0");

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
          'games' => $allGames,
        ]);
    }

    public function configureDashboard(): Dashboard {
        return Dashboard::new()
          ->setTitle('3MONKIES');

    }

    public function configureMenuItems(): iterable {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section("Escape Rooms");
        yield MenuItem::subMenu('Rooms', 'fa fa-building')
          ->setSubItems([
            MenuItem::linkToCrud('Room', 'fa fa-home',
              RoomCrudController::getEntityFqcn()),
            MenuItem::linkToCrud('Default Tips', 'fa fa-question',
              TipCrudController::getEntityFqcn()),
          ]);
        yield MenuItem::linkToCrud('Difficulty', 'fa fa-line-chart',
          DifficultyCrudController::getEntityFqcn());
        yield MenuItem::section("Users");
        yield MenuItem::linkToCrud('Users', 'fa fa-user',
          UserCrudController::getEntityFqcn());
        yield MenuItem::linkToLogout('Logout', 'fa fa-power-off');
    }

}
