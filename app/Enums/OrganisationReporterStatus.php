<?php

namespace App\Enums;

enum OrganisationReporterStatus: string {
    case Unverified = 'unverified';
    case Active = 'active';
    case Paused = 'paused';
    case Archived = 'archived';
}