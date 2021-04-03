<?php

namespace App\Service;

use App\Entity\StatTag;
use App\Repository\StatTagRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Constraints\Date;

class statTagManger
{
    private $params;
    private $statTagRepository;
    private $session;
    private $entityManager;

    public function __construct(
        StatTagRepository $statTagRepository,
        ParameterBagInterface $params,
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ) {
        $this->params = $params;
        $this->statTagRepository = $statTagRepository;
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function addTag(String $name)
    {
        $tag = new StatTag();
        $tag->setName($name);
        $tag->setDate(new DateTime());

        $sessionId = $this->session->getId();
        $tag->setSessionid($sessionId);

        $this->entityManager->persist($tag);
        $this->entityManager->flush();
    }

}
