<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImgContentRepository")
 */
class ImgContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="imgContent")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    public function __toString() {
        // return (string) "Voir les images";
        return $this->getImg();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }
}
