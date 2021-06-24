<?php

namespace App\Service;

use App\Entity\Content;
use App\Entity\Newsletter;
use App\Entity\NewsletterTracker;
use App\Repository\NewsletterEmailRepository;
use App\Repository\NewsletterTrackerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    private $em;

    public function __construct(
        MailerInterface $mailer,
        NewsletterEmailRepository $newsletterEmailRepository,
        EntityManagerInterface $em,
        Environment $twig,
        UserRepository $userRepository,
        ParameterBagInterface $params
    ) {
        $this->mailer = $mailer;
        $this->newsletterEmailRepository = $newsletterEmailRepository;
        $this->em = $em;
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

    public function sendNewsletter(Newsletter $newsletter, bool $sendAgain = null) : int
    {
        //build email
        $email = (new TemplatedEmail())
            ->from($this->params->get("mailer_from"))
            ->subject($newsletter->getSubject());

        $members = [];
        if ($newsletter->getToMembers()) {
            $members = $this->newsletterEmailRepository->findBy([
                'member' => true
            ]);
        }

        $professionals = [];
        if ($newsletter->getToProfessionals()){
            $professionals = $this->newsletterEmailRepository->findBy([
                'professional' => true
            ]);
        }

        $persons = [];
        if ($newsletter->getToPersons()) {
            $persons = $this->newsletterEmailRepository->findBy([
                'professional' => false
            ]);
        }

        $specials = [];
        if ($newsletter->getToSpecial()) {
            $persons = $this->newsletterEmailRepository->findBy([
                'special' => true
            ]);
        }
        
        $members = array_merge($members,$professionals);
        $members = array_merge($members, $persons);
        $members = array_merge($members, $specials);
        //keep only one of each object
        $members = $this->array_unique_full($members);
        //var_dump($members); exit();

        //note : if sendAgain is null or false, the email won't be sent again to someone who already got it
        if (!$sendAgain) {
            //remove previous receivers from list
            $previousReceivers = $this->newsletterEmailRepository->findByNewsletter($newsletter);
            $members = $this->array_remove_full($members, $previousReceivers);
        }

        foreach($members as $member) {
            $email
                ->to($member->getEmail())
                ->htmlTemplate('email/notification.html.twig')
                ->context([
                    'secret' => $member->getSecret(),
                    'newsletter' => $newsletter,
                ]);

            $this->mailer->send($email);

            //record that this newsletter was sent
            $nlt = new NewsletterTracker();
            $nlt->setAddress($member);
            $nlt->setNewsletter($newsletter);
            $nlt->setDate(new \DateTime());
            $this->em->persist($nlt);
            $this->em->flush();
        }

        return count($members);
    }

    private function array_unique_full($arr, $strict = false) {
        return array_filter($arr, function($v, $k) use ($arr, $strict) {
            return array_search($v, $arr, $strict) === $k;
        }, ARRAY_FILTER_USE_BOTH);
    }

    private function array_remove_full($arr, $list) {
        return array_filter($arr, function($v) use ($list) {
            return array_search($v, $list) === false;
        });
    }

    public function testNewsletter(Newsletter $newsletter)
    {
        $email = (new TemplatedEmail())
            ->from($this->params->get("mailer_from"))
            ->subject($newsletter->getSubject());

        $email
            ->to($this->params->get("admin_email"))
            ->htmlTemplate('email/notification.html.twig')
            ->context([
                'secret' => "noSecret",
                'newsletter' => $newsletter,
                'test' => true
            ]);

        $this->mailer->send($email);
    }
}
