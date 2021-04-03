<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\StatTagManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This manages messages from customer to admin
 * This is the contact form management
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(
        Request $request,
        StatTagManager $tagManager,
        MailerInterface $mailer
    ) {
        //record a tag while loading this page
        $tagManager->addTag("contactPageLoading");

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        $adminEmail = $this->getParameter("admin_email");

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $email = (new TemplatedEmail())
                ->from($this->getParameter("mailer_from"))
                ->subject('Nouveau message reçu depuis votre site internet')
                ->to($adminEmail)
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'name' => $contactFormData['name'],
                    'from' => $contactFormData['from'],
                    'message' => $contactFormData['message'],
                ]);

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
         ]);
    }
}
