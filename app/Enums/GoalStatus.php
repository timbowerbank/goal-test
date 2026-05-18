<?php

namespace App\Enums;

enum GoalStatus:string {
    case Draft = 'draft';
    case Active = 'active';
    case Archived = 'archived';
    case Completed = 'completed';
}