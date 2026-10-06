<?php

namespace App\ResponseBuilder;

use App\DTO\Input\Status\SaveStatusInputDTO;
use App\Entity\Status;
use App\Factory\StatusFactory;
use App\Repository\StatusRepository;
use App\Resource\StatusResource;
use App\Resource\TaskResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusResponseBuilder
{
    public function __construct(
        private StatusFactory  $statusFactory,
        private StatusResource $statusResource,
        private TaskResource $taskResource
    )
    {
    }

    public function saveStatus($statusObj, $status = 201, $headers = [], $isJson = true): JsonResponse
    {

        $taskOutputDTO = $this->statusFactory->makeStatusOutputDTO($statusObj);
        $response = $this->statusResource->statusItem($taskOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }

    public function getStatuses(array $statuses, $status = 200, $headers = [], $isJson = true): JsonResponse{
        $tasksOutputDTO=$this->statusFactory->makeStatusesOutputDTO($statuses);
        $response = $this->statusResource->statusCollection($tasksOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function getStatus(Status $statusObj, $status = 200, $headers = [], $isJson = true): JsonResponse{
        $statusOutputDTO=$this->statusFactory->makeStatusOutputDTO($statusObj);
        $response = $this->statusResource->statusItem($statusOutputDTO);
        return new JsonResponse($response, $status, $headers, $isJson);
    }
    public function statusNotFound($status = 404, $headers = [], $isJson = false): JsonResponse{
        return new JsonResponse("Status not found", $status, $headers, $isJson);
    }
    public function deleteStatus($status = 204, $headers = [], $isJson = true): JsonResponse{
        return new JsonResponse("", $status, $headers, $isJson);
    }
    public function deleteStatusWithTasks(array $tasks, string $statusName, $status = 409, $headers = [], $isJson = true): JsonResponse{
        $message = sprintf(
            'Cannot delete status "%s". It is used by task(s):',
            $statusName) . $this->taskResource->taskCollection($tasks);
        return new JsonResponse($message, $status, $headers, $isJson);
    }
    public function invalidStatusJson($status = 400, $headers = [], $isJson = false): JsonResponse{
        return new JsonResponse("Invalid JSON for status", $status, $headers, $isJson);
    }
    public function missingFieldsStatusJson(array $missing, $status = 422, $headers = [], $isJson = false): JsonResponse{
        return new JsonResponse([
            'error' => 'Missing fields: ' . implode(', ', $missing)], $status, $headers, $isJson);
    }

}
