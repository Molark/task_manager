<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
    )
    {
    }
    public function save(Task $task): Task
    {
        $task = $this->taskRepository->save($task);
        return $task;
    }


}
