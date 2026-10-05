<?php

namespace App\DTO\Input\Task;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\StatusExists;

class SaveTaskInputDTO
{
    #[Assert\Length(min: 1, max: 255)]
    #[Assert\NotBlank(normalizer: 'trim')]
    public ?string $title = null;

    #[Assert\NotBlank(normalizer: 'trim')]
    public ?string $description = null;


    #[Assert\NotNull]
    #[StatusExists]
    public string $statusName = "New";


    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $createdAt = null;

    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $updatedAt = null;


}
