<?php

namespace App\Enums;

enum TaskStatus: string {
    case NotStarted = 'not started';
    case InProgress = 'in progress';
    case Complete = 'complete';
    case Archived = 'archived';
}
