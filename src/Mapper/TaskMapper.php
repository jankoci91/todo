<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\ReadTaskDto;
use App\Dto\WriteTaskDto;
use App\Entity\TaskEntity;

class TaskMapper
{
    public function writeEntity(WriteTaskDto $dto, TaskEntity $entity): void
    {
        $entity->setText($dto->text);
        $entity->setChecked($dto->checked);
    }

    public function readEntity(TaskEntity $entity, ReadTaskDto $dto): void
    {
        $dto->id = $entity->getId();
        $dto->text = $entity->getText();
        $dto->checked = $entity->isChecked();
        $dto->created = $entity->getCreated()->format(ReadTaskDto::FORMAT);
    }
}
