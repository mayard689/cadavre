<?php

namespace App\Entity;

use App\Repository\NewsletterEmailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Validator\Constraints as Assert;
use Ambta\DoctrineEncryptBundle\Configuration\Encrypted;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=NewsletterEmailRepository::class)
 * @UniqueEntity("email", message="Cette adresse est déjà enregistrée")
 */
class NewsletterEmail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Encrypted
     *
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secret;

    /**
     * @ORM\Column(type="boolean")
     */
    private $professional;

    /**
     * @ORM\Column(type="boolean")
     */
    private $member;

    /**
     * @ORM\Column(type="boolean")
     */
    private $registered;

    /**
     * @ORM\OneToMany(targetEntity=NewsletterTracker::class, mappedBy="address", orphanRemoval=true)
     */
    private $newsletterTrackers;

    public function __construct()
    {
        $this->newsletterTrackers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function getProfessional(): ?bool
    {
        return $this->professional;
    }

    public function setProfessional(bool $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    public function getMember(): ?bool
    {
        return $this->member;
    }

    public function setMember(bool $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getRegistered(): ?bool
    {
        return $this->registered;
    }

    public function setRegistered(bool $registered): self
    {
        $this->registered = $registered;

        return $this;
    }

    public function toString() : String
    {
        return strval($this->getId());
    }

    /**
     * @return Collection|NewsletterTracker[]
     */
    public function getNewsletterTrackers(): Collection
    {
        return $this->newsletterTrackers;
    }

    public function addNewsletterTracker(NewsletterTracker $newsletterTracker): self
    {
        if (!$this->newsletterTrackers->contains($newsletterTracker)) {
            $this->newsletterTrackers[] = $newsletterTracker;
            $newsletterTracker->setAddress($this);
        }

        return $this;
    }

    public function removeNewsletterTracker(NewsletterTracker $newsletterTracker): self
    {
        if ($this->newsletterTrackers->removeElement($newsletterTracker)) {
            // set the owning side to null (unless already changed)
            if ($newsletterTracker->getAddress() === $this) {
                $newsletterTracker->setAddress(null);
            }
        }

        return $this;
    }
}
