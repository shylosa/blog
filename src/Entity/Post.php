<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationAt;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $headerPost;

    /**
     * @ORM\Column(type="text")
     */
    private $textPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublicationAt(): ?\DateTimeInterface
    {
        return $this->publicationAt;
    }

    public function setPublicationAt(\DateTimeInterface $publicationAt): self
    {
        $this->publicationAt = $publicationAt;

        return $this;
    }

    public function getHeaderPost(): ?string
    {
        return $this->headerPost;
    }

    public function setHeaderPost(string $headerPost): self
    {
        $this->headerPost = $headerPost;

        return $this;
    }

    public function getTextPost(): ?string
    {
        return $this->textPost;
    }

    public function setTextPost(string $textPost): self
    {
        $this->textPost = $textPost;

        return $this;
    }

    public function getCollapsedPost() : string
    {
        return mb_substr($this->getTextPost(),0, 15);
    }
}
