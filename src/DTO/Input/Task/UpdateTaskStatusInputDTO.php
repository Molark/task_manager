<?php

namespace App\DTO\Input\Task;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraint\StatusExists;

class UpdateTaskStatusInputDTO
{
    #[Assert\NotNull]
    #[StatusExists]
    public string $statusName = "Archive";


}
