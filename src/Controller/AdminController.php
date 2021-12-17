<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/interface-admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     */
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/gestion/utilisateurs", name="user_index", methods={"GET"})
     */
    public function userManager(UserRepository $userRepository): Response
    {
        return $this->render('user/admin_user_index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
