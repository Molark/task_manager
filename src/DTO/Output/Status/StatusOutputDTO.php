<?php

namespace App\DTO\Output\Status;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Attribute\Groups;

class StatusOutputDTO
{
    #[Groups(groups: ['task:item', 'status:item'])]
    public ?int $id = null;
    #[Groups(groups: ['task:item', 'status:item'])]
    public ?string $name = null;
    #[Groups(groups: ['task:item', 'status:item'])]
    public ?string $title = null;
}
