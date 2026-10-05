<?php

namespace App\Factory;

use App\DTO\Input\Task\SaveTaskInputDTO;
use App\DTO\Output\Task\TaskOutputDTO;
use App\Entity\Status;
use App\Entity\Task;

use Doctrine\ORM\EntityManagerInterface;

class TaskFactory
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function makeTask(SaveTaskInputDTO $saveTaskInputDTO): Task

    {
        $status = $this->em->getRepository(Status::class)->findOneBy(['name' => $saveTaskInputDTO->statusName]);
        $task = new Task();
        $task->setTitle($saveTaskInputDTO->title);
        $task->setDescription($saveTaskInputDTO->description);
        $task->setStatus($status);
        $task->setCreatedAt($saveTaskInputDTO->createdAt);
        $task->setUpdatedAt($saveTaskInputDTO->updatedAt);
        return $task;
    }

    public function makeSaveTaskInputDTO(array $data): SaveTaskInputDTO
    {
        $task = new SaveTaskInputDTO();

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->statusName = $data['status'];
        $task->createdAt = new \DateTimeImmutable($data['created_at']);
        $task->updatedAt = new  \DateTimeImmutable($data['updated_at']);
        return $task;
    }

    public function makeTaskOutputDTO(Task $task):  TaskOutputDTO
    {
        $taskOutputDTO = new TaskOutputDTO();
        $taskOutputDTO->id = $task->getId();
        $taskOutputDTO->title = $task->getTitle();
        $taskOutputDTO->description = $task->getDescription();
        $taskOutputDTO->status = $task->getStatus();
        $taskOutputDTO->createdAt = $task->getCreatedAt();
        $taskOutputDTO->updatedAt =$task->getUpdatedAt();

        return $taskOutputDTO;
    }

    public function makeTasksOutputDTO(array $tasks): array{
        return array_map(fn($task) => $this->makeTaskOutputDTO($task), $tasks);
    }

}
