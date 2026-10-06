<?php

namespace App\Controller;

use App\DTOValidator\StatusDTOValidator;
use App\Entity\Status;
use App\Factory\StatusFactory;
use App\ResponseBuilder\StatusResponseBuilder;
use App\Service\StatusService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class StatusController
{

    public function __construct(
        private StatusService $statusService,
        private StatusResponseBuilder $statusResponseBuilder,
        private StatusDtoValidator $statusDtoValidator,
        private StatusFactory $statusFactory
    )
    {
    }
    #[Route('/api/statuses', name: 'CreateStatus', methods: ['POST'])]
    public function CreateStatus(Request $request) : JsonResponse{
        $data = json_decode($request->getContent(), true);
        $saveStatusInputDTO = $this->statusFactory->makeSaveStatusInputDTO($data);
        $this->statusDtoValidator->validate($saveStatusInputDTO );
        $status = $this->statusService->save($saveStatusInputDTO);
        return $this->statusResponseBuilder->saveStatus($status);
    }
    #[Route('/api/statuses', name: 'GetStatuses', methods: ['GET'])]
    public function GetStatuses(): JsonResponse
    {
        $statuses = $this->statusService->getStatuses();
        return $this -> statusResponseBuilder->getStatuses($statuses);
    }
    #[Route('/api/statuses/{statusId}', name: 'GetStatus', methods: ['GET'])]
    public function GetStatus(int $statusId): JsonResponse
    {
        $status = $this->statusService->findStatusById($statusId);
        if (!$status) {
            return $this->statusResponseBuilder->statusNotFound();
        }
        return $this -> statusResponseBuilder->getStatus($status);
    }
    #[Route('/api/statuses/{statusId}', name: 'DeleteStaus', methods: ['DELETE'])]
    public function DeleteTask(int $statusId): JsonResponse
    {

        $status = $this->statusService->findStatusById($statusId);
        if (!$status) {
            return $this->statusResponseBuilder->statusNotFound();
        }
        $this->statusService->deleteStatus($status);
        return $this->statusResponseBuilder-> deleteStatus();
    }
}
