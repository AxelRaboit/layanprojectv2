<?php

namespace App\Controller;

use App\Entity\Society;
use App\Form\SocietyType;
use App\Repository\SocietyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/societe", name="society_")
 */
class SocietyController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(SocietyRepository $societyRepository): Response
    {
        return $this->render('society/index.html.twig', [
            'societies' => $societyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouvelle-societe", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $society = new Society();
        $form = $this->createForm(SocietyType::class, $society);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($society);
            $entityManager->flush();

            return $this->redirectToRoute('society_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('society/new.html.twig', [
            'society' => $society,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Society $society): Response
    {
        return $this->render('society/show.html.twig', [
            'society' => $society,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Society $society, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SocietyType::class, $society);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('society_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('society/edit.html.twig', [
            'society' => $society,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Society $society, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$society->getId(), $request->request->get('_token'))) {
            $entityManager->remove($society);
            $entityManager->flush();
        }

        return $this->redirectToRoute('society_index', [], Response::HTTP_SEE_OTHER);
    }
}
