<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ReadTaskDto;
use Symfony\Component\HttpFoundation\JsonResponse;

class ReadTaskListController extends TaskController
{
    public function __invoke(): JsonResponse
    {
        $entityList = $this->manager->findList();
        $dtoList = [];
        foreach ($entityList as $entity) {
            $dto = new ReadTaskDto();
            $this->mapper->readEntity($entity, $dto);
            $dtoList[] = $dto;
        }
        return new JsonResponse(['list' => $dtoList]);
    }
}
