<?php

namespace App\Enums;

enum ManagerStatus: string {
    case Unverified = 'unverified';
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}