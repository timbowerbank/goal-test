<?php

namespace App\Enums;

enum GoalEventType: string {
    case CreateGoal = 'create goal';
    case UpdateGoal = 'update goal';
    case SoftDeleteGoal = 'soft delete goal';
    case HardDeleteGoal = 'hard delete goal';
    case AssignUser = 'assign user';
    case RemoveUser = 'remove user';
    case CompleteGoal = 'complete goal';
    case ArchiveGoal = 'archive goal';
    case AddNote = 'add note';
    case UpdateNote = 'update note';
    case DeleteNote = 'delete note';
    case AddGuide = 'add guide';
    case UpdateGuide = 'update guide';
    case DeleteGuide = 'delete guide';
    case AddCostItem = 'add cost item';
    case UpdateCostItem = 'update cost item';
    case DeleteCostItem = 'delete cost item';
    case AssignReward = 'assign reward';
    case StatusChange = 'status change';
}