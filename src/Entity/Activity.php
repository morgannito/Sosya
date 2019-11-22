<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="activity")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hobbies", mappedBy="activity")
     */
    private $hobbies;

    public function __construct()
    {
        $this->commons = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function __toString() {
        return (string) "Voir les activités";
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
   }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

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
            $hobby->setActivity($this);
        }

        return $this;
    }

    public function removeHobby(Hobbies $hobby): self
    {
        if ($this->hobbies->contains($hobby)) {
            $this->hobbies->removeElement($hobby);
            // set the owning side to null (unless already changed)
            if ($hobby->getActivity() === $this) {
                $hobby->setActivity(null);
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
    public function isHobbyByUser(User $user) : bool 
    {
        foreach($this->hobbies as $hobby) {
            if($hobby->getUser() === $user) return true;
        } 
        
        return false;
    }
}
