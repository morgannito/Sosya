<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeContentRepository")
 */
class LikeContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="likeContents")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="likeContents")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreateAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir le like";
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(?Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->CreateAt;
    }

    public function setCreateAt(\DateTimeInterface $CreateAt): self
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }
}
