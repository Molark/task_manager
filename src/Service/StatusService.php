<?php

namespace App\Service;


use App\DTO\Input\Status\SaveStatusInputDTO;
use App\Entity\Status;
use App\Factory\StatusFactory;
use App\Repository\StatusRepository;


class StatusService
{
    public function __construct(
        private StatusFactory $statusFactory,
        private StatusRepository $statusRepository,
    )
    {
    }
    public function getStatuses() :array
    {
        return $this->statusRepository->findAll();
    }
    public function save(SaveStatusInputDTO $saveTaskInputDTO ): Status
    {
        $task = $this->statusFactory->makeStatus($saveTaskInputDTO);
        return $this->statusRepository->save($task);
    }
    public  function findStatusById(int $id) : ?Status
    {
        return $this->statusRepository->find($id);
    }
    public function deleteStatus(Status $status) : void {
        $this->statusRepository->delete($status);
    }

}
