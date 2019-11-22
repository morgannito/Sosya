<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CivilityRepository")
 */
class Civility
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=47)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=102)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=999, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="civility", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sexe", inversedBy="civility")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sexe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birth;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) "Voir les informations";
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSexe(): ?Sexe
    {
        return $this->sexe;
    }

    public function setSexe(?Sexe $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }
}
