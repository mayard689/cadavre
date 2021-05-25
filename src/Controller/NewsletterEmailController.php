<?php

namespace App\Controller;

use App\Entity\NewsletterEmail;
use App\Form\NewsletterEmailType;
use App\Form\NewsletterSubscriptionType;
use App\Repository\NewsletterEmailRepository;
use DateTime;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/email")
 */
class NewsletterEmailController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_email_index", methods={"GET"})
     */
    public function index(NewsletterEmailRepository $newsletterEmailRepository): Response
    {
        return $this->render('newsletter_email/index.html.twig', [
            'newsletter_emails' => $newsletterEmailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newsletter_email_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsletterEmail = new NewsletterEmail();
        $form = $this->createForm(NewsletterEmailType::class, $newsletterEmail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //make $s a random string
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $secret .= $a{$x}, $i++);

            $newsletterEmail->setDate(new DateTime());
            $newsletterEmail->setSecret($secret);
            $newsletterEmail->setRegistered(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletterEmail);
            $entityManager->flush();

            return $this->redirectToRoute('newsletter_email_index');
        }

        return $this->render('newsletter_email/new.html.twig', [
            'newsletter_email' => $newsletterEmail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inscription", name="newsletter_subscription", methods={"GET","POST"})
     */
    public function getNewsletterForm(
        Request $request,
        MailerInterface $mailer
    ) {
        // Manage newsletter email
        $newsletterEmail = new NewsletterEmail();
        $newsletterForm = $this->createForm(NewsletterSubscriptionType::class, $newsletterEmail);
        $newsletterForm->handleRequest($request);

        if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
            //make $s a random string
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $secret .= $a{$x}, $i++);

            $newsletterEmail->setDate(new DateTime());
            $newsletterEmail->setSecret($secret);
            $newsletterEmail->setRegistered(true);
            $newsletterEmail->setMember(false);
            //$newsletterEmail->setProfessional(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletterEmail);
            $entityManager->flush();

            $this->addFlash('success', 'Votre inscription à la newsletter a été enregistrée');

            $email = (new TemplatedEmail())
                ->from($this->getParameter("mailer_from"))
                ->subject('Votre inscription à la newsletter de '.$this->getParameter("company_name").' !')
                ->to($newsletterEmail->getEmail())
                ->htmlTemplate('email/newsletterSubscription.html.twig')
                ->context([
                    'secret' => $secret,
                ]);

            $mailer->send($email);

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return $this->render('footer/_newsletter.html.twig', [
            'newsletterForm' => $newsletterForm->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_email_show", methods={"GET"})
     */
    public function show(NewsletterEmail $newsletterEmail): Response
    {
        return $this->render('newsletter_email/show.html.twig', [
            'newsletter_email' => $newsletterEmail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newsletter_email_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewsletterEmail $newsletterEmail): Response
    {
        $form = $this->createForm(NewsletterEmailType::class, $newsletterEmail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newsletter_email_index');
        }

        return $this->render('newsletter_email/edit.html.twig', [
            'newsletter_email' => $newsletterEmail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_email_delete", methods={"POST"})
     */
    public function delete(Request $request, NewsletterEmail $newsletterEmail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletterEmail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsletterEmail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newsletter_email_index');
    }
}
