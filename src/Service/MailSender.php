<?php

namespace App\Service;

use App\Entity\Content;
use App\Repository\NewsletterEmailRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class MailSender
{
    private $mailer;
    private $newsletterEmailRepository;
    private $userRepository;
    private $twig;
    private $params;

    public function __construct(
        MailerInterface $mailer,
        NewsletterEmailRepository $newsletterEmailRepository,
        Environment $twig,
        UserRepository $userRepository,
        ParameterBagInterface $params
    ) {
        $this->mailer = $mailer;
        $this->newsletterEmailRepository = $newsletterEmailRepository;
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->params = $params;
    }

    public function notifyContentToMembers(Content $content)
    {
        $email = (new TemplatedEmail())
            ->from($this->params->get("mailer_from"))
            ->subject('Publication du Comité des fêtes de Villereau');

        $members = $this->newsletterEmailRepository->findAll();

        foreach($members as $member) {
            $email
                ->to($member->getEmail())
                ->htmlTemplate('email/contentNotification.html.twig')
                ->context([
                    'secret' => $member->getSecret(),
                    'content' => $content,
                ]);

            $this->mailer->send($email);
        }
    }

}
