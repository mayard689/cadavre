<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsletterRepository::class)
 */
class Newsletter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $toMembers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $toProfessionals;

    /**
     * @ORM\Column(type="boolean")
     */
    private $toPersons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getToMembers(): ?bool
    {
        return $this->toMembers;
    }

    public function setToMembers(bool $toMembers): self
    {
        $this->toMembers = $toMembers;

        return $this;
    }

    public function getToProfessionals(): ?bool
    {
        return $this->toProfessionals;
    }

    public function setToProfessionals(bool $toProfessionals): self
    {
        $this->toProfessionals = $toProfessionals;

        return $this;
    }

    public function getToPersons(): ?bool
    {
        return $this->toPersons;
    }

    public function setToPersons(bool $toPersons): self
    {
        $this->toPersons = $toPersons;

        return $this;
    }
}
