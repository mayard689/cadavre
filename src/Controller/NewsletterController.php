<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterEmailRepository;
use App\Repository\NewsletterRepository;
use App\Service\MailSender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newsletter")
 */
class NewsletterController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_index", methods={"GET"})
     */
    public function index(NewsletterRepository $newsletterRepository): Response
    {
        return $this->render('newsletter/index.html.twig', [
            'newsletters' => $newsletterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newsletter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //make $s a random string
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $secret .= $a{$x}, $i++);

            $newsletter->setChecked(false);
            $newsletter->setVersionning($secret);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('newsletter/new.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_show", methods={"GET"})
     */
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    /**
     * @Route("{id}/test", name="newsletter_test", methods={"GET"})
     */
    public function testNewsletter(Newsletter $newsletter, MailSender $mailSender): Response
    {
        $path = $this->generateUrl('newsletter_unlock', ['id' => $newsletter->getId()]);
        $mailSender->testNewsletter($newsletter);

        $this->addFlash(
            'success',
            'Un email de test a bien été envoyé à l\'administrateur concernant la newsletter '.$newsletter->getSubject()
        );

        return $this->redirectToRoute('newsletter_index');
    }

    /**
     * @Route("{id}/send", name="newsletter_send", methods={"GET"})
     */
    public function sendNewsletter(Newsletter $newsletter, MailSender $mailSender): Response
    {
        if (!$newsletter->getChecked()) {
            $this->addFlash(
                'danger',
                'La newsletter '.$newsletter->getSubject() . ' n\'est pas dévérouillée pour diffusion. Appuyez sur le bouton de test dans l\'index des newsletter pour envoyer la newsletter à l\'administrateur. Puis cliquez sur le bouton de dévérouillage dans le mail si celui ci vous convient.'
            );

            return $this->redirectToRoute('newsletter_index');
        }

        $mailSender->sendNewsletter($newsletter);

        $this->addFlash(
            'success',
            'L\'e-mail '.$newsletter->getSubject() . ' a bien été envoyé.'
        );

        return $this->redirectToRoute('newsletter_index');
    }

    /**
     * @Route("{id}/unlock", name="newsletter_unlock", methods={"GET"})
     */
    public function allow(Newsletter $newsletter): Response
    {
        $newsletter->setChecked(true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newsletter);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'La newsletter '.$newsletter->getSubject(). ' a bien été dévérouillée.'
        );

        return $this->redirectToRoute('newsletter_index');
    }

    /**
     * @Route("/{id}/edit", name="newsletter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newsletter $newsletter): Response
    {
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //make $s a random string
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 32; $x = rand(0,$z), $secret .= $a{$x}, $i++);

            $newsletter->setChecked(false);
            $newsletter->setVersionning($secret);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_delete", methods={"POST"})
     */
    public function delete(Request $request, Newsletter $newsletter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsletter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newsletter_index');
    }

    /**
     * @Route("/stop-email/{secret}", name="confirmStopPub")
     */
    public function confirmStopPub(
        String $secret,
        NewsletterEmailRepository $newsletterEmailRepository,
        EntityManagerInterface $entityManager
    ) {
        $email = $newsletterEmailRepository->findOneBy(['secret'=>$secret]);

        if ($email) {
            $entityManager->remove($email);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez été désinscrit de la liste de diffusion.');
        }

        return $this->redirectToRoute('home');
    }
}
