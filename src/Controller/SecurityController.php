<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController {

    /**
     * @Route("/login_check", name="login_check", methods={"POST"})
     */
    public function login() {
        return $this->json([
          "id" => $this->getUser()->getId(),
          "email" => $this->getUser()->getUserIdentifier(),
          "roles" => $this->getUser()->getRoles(),
          "firstName" => $this->getUser()->getFirstName(),
          "lastName" => $this->getUser()->getLastName(),
        ]);
    }

}