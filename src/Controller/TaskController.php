<?php

namespace App\Controller;

use App\Entity\Task;
use App\Factory\TaskFactory;
use App\Repository\TaskRepository;
use App\ResponseBuilder\TaskResponseBuilder;
use App\Service\TaskService;
use App\Validator\TaskValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function __construct(
        private TaskService $taskService,
        private TaskResponseBuilder $taskResponseBuilder
    )
    {
    }

    #[Route('/api/tasks', name: 'GetTasks', methods: ['GET'])]
    public function GetTasks(): JsonResponse
    {
        $tasks = $this->taskService->getTasks();

        return $this -> taskResponseBuilder->getTasks($tasks);
    }
    #[Route('/api/tasks/{task}', name: 'GetTask', methods: ['GET'])]
    public function GetTask(Task $task): JsonResponse
    {
        return $this -> taskResponseBuilder->getTask($task);
    }
    #[Route('/api/tasks', name: 'CreateTask', methods: ['POST'])]
    public function CreateTask(Request $request,
        TaskService $taskService,
        TaskValidator $taskValidator,
        TaskResponseBuilder $taskResponseBuilder,
        TaskFactory $taskFactory): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $saveTaskInputDTO = $taskFactory->makeSaveTaskInputDTO($data);
        $taskValidator->validate($saveTaskInputDTO );
        $task = $taskService->save($saveTaskInputDTO);
        return $taskResponseBuilder->saveTask($task);
    }
}
