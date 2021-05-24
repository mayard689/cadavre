<?php

namespace App\Entity;

use App\Repository\NewsletterTrackerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsletterTrackerRepository::class)
 */
class NewsletterTracker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Newsletter::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $newsletter;

    /**
     * @ORM\ManyToOne(targetEntity=NewsletterEmail::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsletter(): ?Newsletter
    {
        return $this->newsletter;
    }

    public function setNewsletter(?Newsletter $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getEmail(): ?NewsletterEmail
    {
        return $this->email;
    }

    public function setEmail(?NewsletterEmail $email): self
    {
        $this->email = $email;

        return $this;
    }
}
