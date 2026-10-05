<?php

namespace App\Service;

use App\DTO\Input\Task\SaveTaskInputDTO;
use App\DTO\Input\Task\UpdateTaskStatusInputDTO;
use App\Entity\Status;
use App\Entity\Task;
use App\Factory\TaskFactory;
use App\Repository\StatusRepository;
use App\Repository\TaskRepository;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskFactory $taskFactory,
        private StatusRepository $statusRepository,
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
    public function deleteTask(Task $task) : void {
        $this->taskRepository->delete($task);
    }
    public function findTaskById(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }
    public function getTasksByStatus(string $status): ?array{
        $status = $this->statusRepository->findOneBy(['name' => $status]);
        return $this->taskRepository->findBy(['status' => $status]);
}

}
