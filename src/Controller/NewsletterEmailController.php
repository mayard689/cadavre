<?php

namespace App\Controller;

use App\Entity\NewsletterEmail;
use App\Form\NewsletterEmailType;
use App\Repository\NewsletterEmailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newsletter/email")
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
