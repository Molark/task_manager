<?php

namespace App\DTOValidator;

use App\DTO\Input\Task\SaveTaskInputDTO;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskDTOValidator
{
    public function __construct(private ValidatorInterface $validator)
    {

    }

    public  function validate(SaveTaskInputDTO $task) : void
 {
    $errors = $this->validator->validate($task);
    if (count($errors) > 0) {
        $messages = [];
        foreach ($errors as $error) {
            $messages[$error->getPropertyPath()][] = $error->getMessage();
        }
        throw new \InvalidArgumentException(json_encode($messages));
    }

 }
}
