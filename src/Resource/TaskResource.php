<?php

namespace App\Resource;

use App\Entity\Task;
use Symfony\Component\Serializer\SerializerInterface;

class TaskResource
{
    public function __construct(private SerializerInterface $serializer)
    {

    }

    public function taskItem(Task $task) {
        return $this->serializer->serialize($task, 'json', ['groups' => 'task:item']);
    }

}
