<?php

namespace App\Validator;

use App\Entity\Task;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskValidator
{
    public function __construct(private ValidatorInterface $validator)
    {

    }

    public  function validate(Task $task) : void
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
