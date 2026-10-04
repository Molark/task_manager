<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[Groups(groups: ['status:item'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups(groups: ['status:item'])]
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;
    #[Groups(groups: ['status:item'])]
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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
}
