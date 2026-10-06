<?php

namespace App\Controller;

use App\Factory\TaskFactory;
use App\ResponseBuilder\TaskResponseBuilder;
use App\Service\TaskService;
use App\DTOValidator\TaskDTOValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function __construct(
        private TaskService $taskService,
        private TaskResponseBuilder $taskResponseBuilder,
        private TaskDtoValidator $taskDtoValidator,
        private TaskFactory $taskFactory
    )
    {
    }

    #[Route('/api/tasks', name: 'GetTasks', methods: ['GET'])]
    public function GetTasks(Request $request): JsonResponse
    {
        $status = $request->query->get('status');

        if ($status) {
            $tasks = $this->taskService->getTasksByStatus($status);
        } else {
            $tasks = $this->taskService->getTasks();
        }


        return $this -> taskResponseBuilder->getTasks($tasks);
    }
    #[Route('/api/tasks/{taskId}', name: 'GetTask', methods: ['GET'])]
    public function GetTask(int $taskId): JsonResponse
    {
        $task = $this->taskService->findTaskById($taskId);
        if (!$task) {
            return $this->taskResponseBuilder->taskNotFound();
        }
        return $this -> taskResponseBuilder->getTask($task);
    }
    #[Route('/api/tasks', name: 'CreateTask', methods: ['POST'])]
    public function CreateTask(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $saveTaskInputDTO = $this->taskFactory->makeSaveTaskInputDTO($data);
        $this->taskDtoValidator->validate($saveTaskInputDTO );
        $task = $this->taskService->save($saveTaskInputDTO);
        return $this->taskResponseBuilder->saveTask($task);
    }
    #[Route('/api/tasks/{taskId}/status', name: 'UpdateTaskStatus', methods: ['PATCH'])]
    public function UpdateTask(int $taskId, Request $request,): JsonResponse
    {
        $task = $this->taskService->findTaskById($taskId);
        if (!$task) {
            return $this->taskResponseBuilder->taskNotFound();
        }

        $data = json_decode($request->getContent(), true);
        $updateTaskStatusInputDTO = $this->taskFactory->makeUpdateTaskStatusInputDTO($data);
        $this->taskDtoValidator->validate($updateTaskStatusInputDTO);
        $task = $this->taskService->updateStatus($task, $updateTaskStatusInputDTO);
        return $this->taskResponseBuilder->updateTask($task);
    }
    #[Route('/api/tasks/{taskId}', name: 'DeleteTask', methods: ['DELETE'])]
    public function DeleteTask(int $taskId): JsonResponse
    {

        $task = $this->taskService->findTaskById($taskId);
        if (!$task) {
            return $this->taskResponseBuilder->taskNotFound();
        }
        $this->taskService->deleteTask($task);
        return $this->taskResponseBuilder->deleteTask();
    }
}
