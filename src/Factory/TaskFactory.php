<?php

namespace App\Factory;

use App\Entity\Task;

class TaskFactory
{
public function __construct()
{
}
public function makeTask(array $data): Task{
    $task = new Task();
    $task->setTitle($data['title']);
    $task->setDescription($data['description']);
    $task->setStatus($data['status']);
    $task->setCreatedAt(new \DateTimeImmutable( $data['created_at']));
    $task->setUpdatedAt(new \DateTimeImmutable($data['updated_at']));
    return $task;
}
}
