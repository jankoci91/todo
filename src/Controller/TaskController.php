<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manager\TaskManager;
use App\Mapper\TaskMapper;

abstract class TaskController implements Controller
{
    protected TaskManager $manager;

    protected TaskMapper $mapper;

    public function __construct(TaskManager $manager, TaskMapper $mapper)
    {
        $this->manager = $manager;
        $this->mapper = $mapper;
    }
}
