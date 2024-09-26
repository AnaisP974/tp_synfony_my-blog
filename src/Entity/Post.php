<?php

namespace App\Entity;

use App\Entity\Timestamps;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post extends Timestamps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $is_public = null;

    #[ORM\Column]
    private ?bool $is_premium = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $signature = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->deleted_at = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isPublic(): ?bool
    {
        return $this->is_public;
    }

    public function setPublic(bool $is_public): static
    {
        $this->is_public = $is_public;

        return $this;
    }

    public function isPremium(): ?bool
    {
        return $this->is_premium;
    }

    public function setPremium(bool $is_premium): static
    {
        $this->is_premium = $is_premium;

        return $this;
    }

    public function getSignature(): ?User
    {
        return $this->signature;
    }

    public function setSignature(?User $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

}
