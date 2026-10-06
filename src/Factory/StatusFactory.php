<?php

namespace App\Factory;

use App\DTO\Input\Status\SaveStatusInputDTO;
use App\DTO\Output\Status\StatusOutputDTO;
use App\Entity\Status;


class StatusFactory
{
    public function makeStatus(SaveStatusInputDTO $saveStatusInputDTO): Status

    {
        $status= new Status();
        $status->setName($saveStatusInputDTO->name);
        $status->setTitle($saveStatusInputDTO->title);
        return $status;
    }

    public function makeSaveStatusInputDTO(array $data): SaveStatusInputDTO
    {
        $status = new SaveStatusInputDTO();
        $status->name = $data['name'] ?? null;
        $status->title = $data['title'] ?? null;

        return  $status;
    }
    public function makeStatusOutputDTO(Status $status):  StatusOutputDTO
    {
        $statusOutputDTO = new StatusOutputDTO();
        $statusOutputDTO ->id = $status->getId();
        $statusOutputDTO ->name = $status->getName();
        $statusOutputDTO ->title = $status->getTitle();

        return  $statusOutputDTO;
    }
    public function makeStatusesOutputDTO(array $statuses): array{
        return array_map(fn($status) => $this->makeStatusOutputDTO($status), $statuses);
    }

}
