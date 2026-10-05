<?php

namespace App\Validator;

use App\Repository\StatusRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StatusExistsValidator extends ConstraintValidator
{
    public function __construct(private StatusRepository $statusRepository) {}

    public function validate(mixed $value, Constraint $constraint): void
    {

        if (!$value || !$this->statusRepository->findOneBy(['name' => $value])) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
