<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ReadTaskDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskController extends TaskController
{
    public function __invoke(int $id): JsonResponse
    {
        $entity = $this->manager->find($id);
        if (empty($entity)) {
            return new JsonResponse(['error' => "Task $id not found."], Response::HTTP_NOT_FOUND);
        }
        $dto = new ReadTaskDto();
        $this->mapper->readEntity($entity, $dto);
        $this->manager->remove($entity);
        $this->manager->flush();
        return new JsonResponse($dto);
    }
}
