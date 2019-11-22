<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
* @ORM\Entity
* @ORM\Table(name="fos_user")
*/
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DataUser", mappedBy="user", cascade={"persist", "remove"})
     */
    private $dataUser;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Civility", mappedBy="user", cascade={"persist", "remove"})
     */
    private $civility;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Follow", mappedBy="follower")
     */
    private $followers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Follow", mappedBy="following")
     */
    private $followings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hobbies", mappedBy="user")
     */
    private $hobbies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Identify", mappedBy="user")
     */
    private $identifies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentContent", mappedBy="user")
     */
    private $commentContents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="user")
     */
    private $contents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LikeContent", mappedBy="user")
     */
    private $likeContents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Report", mappedBy="reportedBy")
     */
    private $reports;

    public function __construct()
    {
        parent::__construct();
        $this->commons = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->followings = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
        $this->identifies = new ArrayCollection();
        $this->commentContents = new ArrayCollection();
        $this->contents = new ArrayCollection();
        $this->likeContents = new ArrayCollection();
        $this->reports = new ArrayCollection();
        // your own logic
    }
    
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir l'utilisateur";
    }

    public function getDataUser(): ?DataUser
    {
        return $this->dataUser;
    }

    public function setDataUser(?DataUser $dataUser): self
    {
        $this->dataUser = $dataUser;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $dataUser === null ? null : $this;
        if ($newUser !== $dataUser->getUser()) {
            $dataUser->setUser($newUser);
        }

        return $this;
    }

    public function getCivility(): ?Civility
    {
        return $this->civility;
    }

    public function setCivility(?Civility $civility): self
    {
        $this->civility = $civility;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $civility === null ? null : $this;
        if ($newUser !== $civility->getUser()) {
            $civility->setUser($newUser);
        }

        return $this;
    }

    /**
     * @return Collection|Follow[]
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    public function addFollower(Follow $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->setFollower($this);
        }

        return $this;
    }

    public function removeFollower(Follow $follower): self
    {
        if ($this->followers->contains($follower)) {
            $this->followers->removeElement($follower);
            // set the owning side to null (unless already changed)
            if ($follower->getFollower() === $this) {
                $follower->setFollower(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Follow[]
     */
    public function getFollowings(): Collection
    {
        return $this->followings;
    }

    public function addFollowing(Follow $following): self
    {
        if (!$this->followings->contains($following)) {
            $this->followings[] = $following;
            $following->setFollowing($this);
        }

        return $this;
    }

    public function removeFollowing(Follow $following): self
    {
        if ($this->followings->contains($following)) {
            $this->followings->removeElement($following);
            // set the owning side to null (unless already changed)
            if ($following->getFollowing() === $this) {
                $following->setFollowing(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hobbies[]
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobbies $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
            $hobby->setUser($this);
        }

        return $this;
    }

    public function removeHobby(Hobbies $hobby): self
    {
        if ($this->hobbies->contains($hobby)) {
            $this->hobbies->removeElement($hobby);
            // set the owning side to null (unless already changed)
            if ($hobby->getUser() === $this) {
                $hobby->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Identify[]
     */
    public function getIdentifies(): Collection
    {
        return $this->identifies;
    }

    public function addIdentify(Identify $identify): self
    {
        if (!$this->identifies->contains($identify)) {
            $this->identifies[] = $identify;
            $identify->setUser($this);
        }

        return $this;
    }

    public function removeIdentify(Identify $identify): self
    {
        if ($this->identifies->contains($identify)) {
            $this->identifies->removeElement($identify);
            // set the owning side to null (unless already changed)
            if ($identify->getUser() === $this) {
                $identify->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentContent[]
     */
    public function getCommentContents(): Collection
    {
        return $this->commentContents;
    }

    public function addCommentContent(CommentContent $commentContent): self
    {
        if (!$this->commentContents->contains($commentContent)) {
            $this->commentContents[] = $commentContent;
            $commentContent->setUser($this);
        }

        return $this;
    }

    public function removeCommentContent(CommentContent $commentContent): self
    {
        if ($this->commentContents->contains($commentContent)) {
            $this->commentContents->removeElement($commentContent);
            // set the owning side to null (unless already changed)
            if ($commentContent->getUser() === $this) {
                $commentContent->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setUser($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->contains($content)) {
            $this->contents->removeElement($content);
            // set the owning side to null (unless already changed)
            if ($content->getUser() === $this) {
                $content->setUser(null);
            }
        }

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
            $likeContent->setUser($this);
        }

        return $this;
    }

    public function removeLikeContent(LikeContent $likeContent): self
    {
        if ($this->likeContents->contains($likeContent)) {
            $this->likeContents->removeElement($likeContent);
            // set the owning side to null (unless already changed)
            if ($likeContent->getUser() === $this) {
                $likeContent->setUser(null);
            }
        }

        return $this;
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
            $report->setReportedBy($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getReportedBy() === $this) {
                $report->setReportedBy(null);
            }
        }

        return $this;
    }

    /**
     * Savoir si l'utilisateur a ce loisir
     *
     * @param User $user
     * @return boolean
     */
    public function isFollowByUser(User $user) : bool 
    {
        foreach($this->followings as $follow) {
            if($follow->getFollower() === $user) return true;
        } 
        
        return false;
    }
}