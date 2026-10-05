<?php

namespace App\Resource;

use App\DTO\Output\Task\TaskOutputDTO;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class TaskResource
{
    public function __construct(private SerializerInterface $serializer)
    {

    }

    public function taskItem(TaskOutputDTO $taskOutputDTO):string {
        return $this->serializer->serialize($taskOutputDTO, 'json', ['groups' => 'task:item']);
    }
    public function taskCollection(array $tasks) : string{
        return $this->serializer->serialize($tasks, 'json', ['groups' => 'task:item']);
    }

}
