<?php

namespace App\DTO\Input\Status;
use Symfony\Component\Validator\Constraints as Assert;
class SaveStatusInputDTO
{


    #[Assert\NotBlank(normalizer: 'trim')]
    public ?string $name = null;
    #[Assert\NotBlank(normalizer: 'trim')]
    public ?string $title = null;

}
