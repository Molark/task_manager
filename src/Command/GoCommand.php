<?php

namespace App\Command;

use App\Entity\Task;
use App\Service\TaskService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\TaskRepository;
#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand{
    public function __invoke(
        SymfonyStyle $io,
        TaskService $taskService,
        EntityManagerInterface $em,
      //  #[Argument('ID поста')] int $taskId = 1, // ← А это аргумент командной строки
    ): int {
        // Используем репозиторий напрямую
       $data = [
        'title' => 'third',
           'description' => 'Aadasffhghjgfdsaur command',
           'status' => 'adsfge',
           'created_at' => '2027-08-09',
           'updated_at' => '2029-08-09',
       ];
        $task = new Task();
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);
        $task->setCreatedAt(new \DateTimeImmutable( $data['created_at']));
        $task->setUpdatedAt(new \DateTimeImmutable($data['updated_at']));

        $task = $taskService->save($task);
        dd($task);
        return Command::SUCCESS;
    }
}
