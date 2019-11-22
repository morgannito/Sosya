<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 */
class Report
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reports")
     * @ORM\JoinColumn(nullable=true)
     */
    private $reportedBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CommentContent", inversedBy="reports")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reports")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="reports")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=999)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir le report";
    }

    public function getReportedBy(): ?User
    {
        return $this->reportedBy;
    }

    public function setReportedBy(?User $reportedBy): self
    {
        $this->reportedBy = $reportedBy;

        return $this;
    }

    public function getComment(): ?CommentContent
    {
        return $this->comment;
    }

    public function setComment(?CommentContent $comment): self
    {
        $this->comment = $comment;

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

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(?Content $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
