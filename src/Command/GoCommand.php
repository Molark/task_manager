<?php

namespace App\Command;

use App\Entity\Task;
use App\Factory\TaskFactory;
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
        TaskFactory $taskFactory,

    ): int {
       $data = [
        'title' => 'asd',
           'description' => 'noasd',
           'status' => "testStatus",
           'created_at' => '2027-01-09',
           'updated_at' => '2029-08-09',
       ];
        //request
        $saveTaskInputDTO = $taskFactory->makeSaveTaskInputDTO($data);
        $taskValidator->validate($saveTaskInputDTO );

        $task = $taskService->save($saveTaskInputDTO);
        $resp = $taskResponseBuilder->saveTask($task);
        dd($resp);
        return Command::SUCCESS;
    }
}

