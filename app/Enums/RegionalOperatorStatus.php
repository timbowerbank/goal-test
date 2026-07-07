<?php

namespace App\Enums;

enum RegionalOperatorStatus: string {
    case Unverified = 'unverified';
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}