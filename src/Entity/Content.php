<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=999)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentContent", mappedBy="content")
     */
    private $commentContent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImgContent", mappedBy="content")
     */
    private $imgContent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Identify", mappedBy="content")
     */
    private $identify;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LikeContent", mappedBy="content")
     */
    private $likeContents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Report", mappedBy="content")
     */
    private $reports;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    public function __construct()
    {
        $this->commentContent = new ArrayCollection();
        $this->imgContent = new ArrayCollection();
        $this->identify = new ArrayCollection();
        $this->likeContents = new ArrayCollection();
        $this->reports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir la publication";
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return Collection|CommentContent[]
     */
    public function getCommentContent(): Collection
    {
        return $this->commentContent;
    }

    public function addCommentContent(CommentContent $commentContent): self
    {
        if (!$this->commentContent->contains($commentContent)) {
            $this->commentContent[] = $commentContent;
            $commentContent->setContent($this);
        }

        return $this;
    }

    public function removeCommentContent(CommentContent $commentContent): self
    {
        if ($this->commentContent->contains($commentContent)) {
            $this->commentContent->removeElement($commentContent);
            // set the owning side to null (unless already changed)
            if ($commentContent->getContent() === $this) {
                $commentContent->setContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ImgContent[]
     */
    public function getImgContent(): Collection
    {
        return $this->imgContent;
    }

    public function addImgContent(ImgContent $imgContent): self
    {
        if (!$this->imgContent->contains($imgContent)) {
            $this->imgContent[] = $imgContent;
            $imgContent->setContent($this);
        }

        return $this;
    }

    public function removeImgContent(ImgContent $imgContent): self
    {
        if ($this->imgContent->contains($imgContent)) {
            $this->imgContent->removeElement($imgContent);
            // set the owning side to null (unless already changed)
            if ($imgContent->getContent() === $this) {
                $imgContent->setContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Identify[]
     */
    public function getIdentify(): Collection
    {
        return $this->identify;
    }

    public function addIdentify(Identify $identify): self
    {
        if (!$this->identify->contains($identify)) {
            $this->identify[] = $identify;
            $identify->setContent($this);
        }

        return $this;
    }

    public function removeIdentify(Identify $identify): self
    {
        if ($this->identify->contains($identify)) {
            $this->identify->removeElement($identify);
            // set the owning side to null (unless already changed)
            if ($identify->getContent() === $this) {
                $identify->setContent(null);
            }
        }

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

    /**
     * @return Collection|LikeContent[]
     */
    public function getLikeContents(): Collection
    {
        return $this->likeContents;
    }

    public function addLikeContent(LikeContent $likeContent): self
    {
        if (!$this->likeContents->contains($likeContent)) {
            $this->likeContents[] = $likeContent;
            $likeContent->setContent($this);
        }

        return $this;
    }

    public function removeLikeContent(LikeContent $likeContent): self
    {
        if ($this->likeContents->contains($likeContent)) {
            $this->likeContents->removeElement($likeContent);
            // set the owning side to null (unless already changed)
            if ($likeContent->getContent() === $this) {
                $likeContent->setContent(null);
            }
        }

        return $this;
    }

    /**
     * Savoir si le commentaire est liké par l'utilisateur
     *
     * @param User $user
     * @return boolean
     */
    public function isLikedByUser(User $user) : bool 
    {
        foreach($this->likeContents as $like) {
            if($like->getUser() === $user) return true;
        } return false;
    }

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setContent($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getContent() === $this) {
                $report->setContent(null);
            }
        }

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }
}
