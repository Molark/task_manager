<?php

namespace App\Resource;

use App\DTO\Output\Status\StatusOutputDTO;
use Symfony\Component\Serializer\SerializerInterface;

class StatusResource
{
    public function __construct(private SerializerInterface $serializer)
    {

    }

    public function statusItem(StatusOutputDTO $statusOutputDTO):string {
        return $this->serializer->serialize($statusOutputDTO, 'json', ['groups' => 'status:item']);
    }
    public function statusCollection(array $tasks) : string{
        return $this->serializer->serialize($tasks, 'json', ['groups' => 'status:item']);
    }
}
