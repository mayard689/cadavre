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

    /**
     * @ORM\Column(type="boolean")
     */
    private $checked;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $versionning;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $toSpecial;

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

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getVersionning(): ?string
    {
        return $this->versionning;
    }

    public function setVersionning(string $versionning): self
    {
        $this->versionning = $versionning;

        return $this;
    }

    public function getToSpecial(): ?bool
    {
        return $this->toSpecial;
    }

    public function setToSpecial(?bool $toSpecial): self
    {
        $this->toSpecial = $toSpecial;

        return $this;
    }
}
