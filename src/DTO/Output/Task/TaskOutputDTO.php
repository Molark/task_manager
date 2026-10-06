<?php

namespace App\DTO\Output\Task;

use App\DTO\Output\Status\StatusOutputDTO;
use App\Entity\Status;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Attribute\Groups;

class TaskOutputDTO
{
    #[Groups(groups: ['task:item'])]
    public ?int $id = null;
    #[Groups(groups: ['task:item'])]
    public ?string $title = null;
    #[Groups(groups: ['task:item'])]
    public ?string $description = null;

    #[Groups(groups: ['task:item'])]
    public ?StatusOutputDTO $status = null;

    #[Groups(groups: ['task:item'])]
    public ?\DateTimeImmutable $createdAt = null;

    #[Groups(groups: ['task:item'])]
    public ?\DateTimeImmutable $updatedAt = null;
}
