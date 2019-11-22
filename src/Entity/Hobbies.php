<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HobbiesRepository")
 */
class Hobbies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hobbies")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="hobbies")
     */
    private $activity;

    public function __toString() {
        return (string) "Voir le loisir";
    }
    
    public function getId(): ?int
    {
        return $this->id;
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

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
