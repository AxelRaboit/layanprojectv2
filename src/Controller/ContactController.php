<?php

namespace App\Controller;

use App\Form\ContactCustomerType;
use Symfony\Component\Mailer\Mailer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contact", name="email_")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/customer/{id}", name="customer")
     */
    public function contactCustomer(
        $id,
        Request $request,
        CustomerRepository $customerRepository,
        MailerInterface $mailer,
        EntityManagerInterface $entityManager
        ): Response
    {
        $customer = $customerRepository->find($id);

        $form = $this->createForm(ContactCustomerType::class);

        $currentUser = $this->getUser();
        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $email = (new TemplatedEmail())
                ->from($currentUser->getEmail())
                ->to($customer->getEmail())
                ->subject($contact['subject']->getData())
                ->htmlTemplate('contact/contact_customer.html.twig')
                ->context([
                    'from' => $contact['from']->getData(),
                    'to' => $contact['to']->getData(),
                    'message' => $contact['message']->getData(),
                ]);
                $mailer->send($email);

                $customer->setLastEmailDate(new \DateTime('now'));

                $entityManager->persist($customer);
                $entityManager->flush();

                $this->addFlash('message', 'Votre email à bien été envoyé');

                return $this->redirectToRoute('customer_index');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'customer' => $customer
        ]);
    }
}
