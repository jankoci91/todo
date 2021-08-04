<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\TaskEntity;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class TaskManager
{
    private EntityManagerInterface $manager;

    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->repository = $manager->getRepository(TaskEntity::class);
    }

    public function flush(): void
    {
        $this->manager->flush();
    }

    public function create(): TaskEntity
    {
        $entity = new TaskEntity();
        $this->manager->persist($entity);

        return $entity;
    }

    public function find(int $id): ?TaskEntity
    {
        return $this->repository->find($id);
    }

    public function findList(): array
    {
        return $this->repository->findBy([], [TaskEntity::CHECKED => Criteria::ASC, TaskEntity::CREATED => Criteria::DESC]);
    }

    public function remove(TaskEntity $entity): void
    {
        $this->manager->remove($entity);
    }
}
