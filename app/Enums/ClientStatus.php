<?php

namespace App\Enums;

enum ClientStatus: string {
    case Unverified = 'unverified';
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}