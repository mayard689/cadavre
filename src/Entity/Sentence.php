<?php

namespace App\Entity;

use App\Repository\SentenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity=Sentence::class, inversedBy="followings")
     */
    private $previous;

    /**
     * @ORM\OneToMany(targetEntity=Sentence::class, mappedBy="previous")
     */
    private $followings;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $secret;

    public function __construct()
    {
        $this->followings = new ArrayCollection();
    }

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

    public function getPrevious(): ?self
    {
        return $this->previous;
    }

    public function setPrevious(?self $previous): self
    {
        $this->previous = $previous;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFollowings(): Collection
    {
        return $this->followings;
    }

    public function addFollowing(self $following): self
    {
        if (!$this->followings->contains($following)) {
            $this->followings[] = $following;
            $following->setPrevious($this);
        }

        return $this;
    }

    public function removeFollowing(self $following): self
    {
        if ($this->followings->removeElement($following)) {
            // set the owning side to null (unless already changed)
            if ($following->getPrevious() === $this) {
                $following->setPrevious(null);
            }
        }

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
}
