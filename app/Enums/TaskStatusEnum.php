<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumToArray;

enum TaskStatusEnum: string
{
    use EnumToArray;

    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
