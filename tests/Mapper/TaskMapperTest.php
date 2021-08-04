<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\ReadTaskDto;
use App\Dto\WriteTaskDto;
use App\Entity\TaskEntity;
use DateTime;
use PHPUnit\Framework\TestCase;

class TaskMapperTest extends TestCase
{
    public function testWriteEntity(): void
    {
        $dto = new WriteTaskDto();
        $dto->text = 'test';
        $dto->checked = true;
        $entity = new TaskEntity();
        $mapper = new TaskMapper();
        $mapper->writeEntity($dto, $entity);

        self::assertEquals($dto->text, $entity->getText());
        self::assertEquals($dto->checked, $entity->isChecked());
    }

    public function testReadEntity(): void
    {
        $entity = $this->createMock(TaskEntity::class);
        $entity->method('getId')->willReturn(1);
        $entity->method('getText')->willReturn('test');
        $entity->method('isChecked')->willReturn(true);
        $now = new DateTime();
        $entity->method('getCreated')->willReturn($now);
        $dto = new ReadTaskDto();
        $mapper = new TaskMapper();
        $mapper->readEntity($entity, $dto);

        self::assertEquals($dto->id, $entity->getId());
        self::assertEquals($dto->text, $entity->getText());
        self::assertEquals($dto->checked, $entity->isChecked());
        self::assertEquals($dto->created, $entity->getCreated()->format(ReadTaskDto::FORMAT));
    }
}
