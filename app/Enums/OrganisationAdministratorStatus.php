<?php

namespace App\Enums;

enum OrganisationAdministratorStatus: string {
    case Unverified = 'unverified';
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}