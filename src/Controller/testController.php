<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController {
    /**
     * @Route("/home", name="app_home")
     */
    public function home() {
        return $this->render('test/home.html.twig');
    }
}