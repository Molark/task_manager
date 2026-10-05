<?php

namespace App\Validator\Constraint;

use App\Validator\StatusExistsValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class StatusExists extends Constraint
{
    public string $message = 'Status "{{ value }}" does not exist.';

    public function __construct(mixed $options = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return StatusExistsValidator::class;
    }

}
