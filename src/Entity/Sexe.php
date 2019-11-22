<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SexeRepository")
 */
class Sexe
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
     * @ORM\OneToMany(targetEntity="App\Entity\Civility", mappedBy="sexe", orphanRemoval=true)
     */
    private $civility;

    public function __construct()
    {
        $this->civility = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir le genre";
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

    /**
     * @return Collection|Civility[]
     */
    public function getCivility(): Collection
    {
        return $this->civility;
    }

    public function addCivility(Civility $civility): self
    {
        if (!$this->civility->contains($civility)) {
            $this->civility[] = $civility;
            $civility->setSexe($this);
        }

        return $this;
    }

    public function removeCivility(Civility $civility): self
    {
        if ($this->civility->contains($civility)) {
            $this->civility->removeElement($civility);
            // set the owning side to null (unless already changed)
            if ($civility->getSexe() === $this) {
                $civility->setSexe(null);
            }
        }

        return $this;
    }
}
