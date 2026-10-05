<?php

namespace App\ResponseBuilder;

use App\Entity\Task;
use App\Factory\TaskFactory;
use App\Resource\TaskResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskResponseBuilder
{
    public function __construct( private  TaskResource $taskResource, private TaskFactory $taskFactory )
    {
    }

    public function saveTask(Task $task, $status = 201, $headers = [], $isJson = true): JsonResponse{

        $taskOutputDTO=$this->taskFactory->makeTaskOutputDTO($task);
        $response = $this->taskResource->taskItem($taskOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function getTasks(array $tasks, $status = 200, $headers = [], $isJson = true): JsonResponse{
        $tasksOutputDTO=$this->taskFactory->makeTasksOutputDTO($tasks);
        $response = $this->taskResource->taskCollection($tasksOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function getTask(Task $task, $status = 200, $headers = [], $isJson = true): JsonResponse{
        $taskOutputDTO=$this->taskFactory->makeTaskOutputDTO($task);
        $response = $this->taskResource->taskItem($taskOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function updateTask(Task $task, $status = 200, $headers = [], $isJson = true): JsonResponse{

        $taskOutputDTO=$this->taskFactory->makeTaskOutputDTO($task);
        $response = $this->taskResource->taskItem($taskOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function deleteTask($status = 204, $headers = [], $isJson = true): JsonResponse{
        return new JsonResponse("", $status, $headers, $isJson);
    }
    public function taskNotFound($status = 404, $headers = [], $isJson = false): JsonResponse{
        return new JsonResponse("Task not found", $status, $headers, $isJson);
    }
}
