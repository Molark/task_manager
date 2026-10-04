<?php

namespace App\ResponseBuilder;

use App\Entity\Task;
use App\Resource\TaskResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskResponseBuilder
{
    public function __construct( private  TaskResource $taskResource)
    {
    }

    public function saveTask(Task $task, $status = 201, $headers = [], $isJson = true): JsonResponse{
       $response = $this->taskResource->taskItem($task);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
}
