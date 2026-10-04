<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[Groups(groups: ['task:item'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups(groups: ['task:item'])]
    #[Assert\Length(min: 1, max: 255)]
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[ORM\Column(length: 255)]
    private ?string $title = null;
    #[Groups(groups: ['task:item'])]
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Groups(groups: ['task:item'])]
    #[ORM\Column(length: 20)]
    #[Assert\Choice(
        choices: ['New', 'In-progress', 'Done', 'Archive'],
        message: 'Выберите корректный статус задачи: New, In-progress, Done или Archive.'
    )]
    private ?string $status = "New";
    #[Groups(groups: ['task:item'])]
    #[Assert\Type(\DateTimeImmutable::class)]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups(groups: ['task:item'])]
    #[Assert\Type(\DateTimeImmutable::class)]
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable  $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
