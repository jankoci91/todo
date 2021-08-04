<?php

declare(strict_types=1);

namespace App\Dto;

class ReadTaskDto
{
    public const FORMAT = 'c';

    public $id;

    public $text;

    public $checked;

    public $created;
}
