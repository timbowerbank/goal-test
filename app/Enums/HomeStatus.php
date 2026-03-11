<?php

namespace App\Enums;

enum HomeStatus: string {
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}