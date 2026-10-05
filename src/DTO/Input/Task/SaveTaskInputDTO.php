<?php

namespace App\DTO\Input\Task;

use App\DTO\Input\Assert;
use App\Entity\Status;

class SaveTaskInputDTO
{
    #[Assert\Length(min: 1, max: 255)]
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    public ?string $title = null;

    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    public ?string $description = null;


    #[Assert\NotNull(allowNull: null)]
    public string $statusName = "New";


    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $createdAt = null;

    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $updatedAt = null;


}
