<?php

namespace App\Exception;

use RuntimeException;

class ValidateException extends RuntimeException
{
public function __construct(private array $errors)
{

    parent::__construct('Invalidate arguments', 422);
}

    public function getErrors(): array
    {
        return $this->errors;
    }

}
