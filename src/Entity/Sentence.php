<?php

namespace App\Entity;

use App\Repository\SentenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SentenceRepository::class)
 */
class Sentence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Chapter::class, inversedBy="sentences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapter;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChapter(): ?chapter
    {
        return $this->chapter;
    }

    public function setChapter(?chapter $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }
}
