<?php

namespace App\DTOValidator;

use App\DTO\Input\Status\SaveStatusInputDTO;
use App\Exception\ValidateException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StatusDTOValidator
{
    public function __construct(private ValidatorInterface $validator)
    {

    }

    public  function validate(SaveStatusInputDTO $status) : void
    {
        $errors = $this->validator->validate($status);
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }
            throw new ValidateException($messages);
        }

    }
}
