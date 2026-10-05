<?php

namespace App\Service;

use App\DTO\Input\Task\SaveTaskInputDTO;
use App\DTO\Input\Task\UpdateTaskStatusInputDTO;
use App\Entity\Task;
use App\Factory\TaskFactory;
use App\Repository\TaskRepository;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskFactory $taskFactory,
    )
    {
    }


    public function getTasks() :array {
        return $this->taskRepository->findAll();
    }

    public function save(SaveTaskInputDTO $saveTaskInputDTO ): Task
    {
        $task = $this->taskFactory->makeTask($saveTaskInputDTO);
        return $this->taskRepository->save($task);
    }
    public function updateStatus(Task $task, UpdateTaskStatusInputDTO $updateTaskStatusInputDTO ): Task
    {
        $task = $this->taskFactory->updateTaskStatus($task, $updateTaskStatusInputDTO);
        return $this->taskRepository->save($task);
    }

}
