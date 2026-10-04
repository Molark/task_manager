<?php

namespace App\Command;

use App\Entity\Task;
use App\Resource\TaskResource;
use App\ResponseBuilder\TaskResponseBuilder;
use App\Service\TaskService;
use App\Validator\TaskValidator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\TaskRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand{
    public function __invoke(
        SymfonyStyle $io,
        TaskService $taskService,
        EntityManagerInterface $em,
        TaskValidator $taskValidator,
        TaskResponseBuilder $taskResponseBuilder,

    ): int {
       $data = [
        'title' => 'asd',
           'description' => 'noasd',
           'status' => 'New',
           'created_at' => '2027-01-09',
           'updated_at' => '2029-08-09',
       ];
        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);
        $task->setCreatedAt(new \DateTimeImmutable( $data['created_at']));
        $task->setUpdatedAt(new \DateTimeImmutable($data['updated_at']));

        $taskValidator->validate($task);

        $task = $taskService->save($task);
        $resp = $taskResponseBuilder->saveTask($task);
        dd($resp);
        return Command::SUCCESS;
    }
}
