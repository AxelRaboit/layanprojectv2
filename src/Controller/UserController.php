<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/interface-utilisateur", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
}
