<?php

namespace App\Controller;

use App\Form\SubscribeType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class SubscribeController extends AbstractController
{
    /**
     * @Route("/nous-rejoindre", name="subscribe")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(SubscribeType::class);

        $form->handleRequest($request);

        $adminEmail = $this->getParameter("admin_email");

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $email = (new TemplatedEmail())
                ->from($this->getParameter("mailer_from"))
                ->subject('Vous avez reçu une demande d\'adhésion depuis votre site internet')
                ->to($adminEmail)
                ->htmlTemplate('email/subscribe.html.twig')
                ->context([
                    'name' => $contactFormData['name'],
                    'emailAddress' => $contactFormData['email'],
                    'phone' => $contactFormData['phone'],
                    'street' => $contactFormData['street'],
                    'zipcode' => $contactFormData['zipcode'],
                    'city' => $contactFormData['city'],
                    'message' => $contactFormData['message'],
                ]);

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre demande d\'adhésion a bien été envoyée'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/subscribe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
