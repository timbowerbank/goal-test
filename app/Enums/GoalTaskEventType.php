<?php

namespace App\Enums;

enum GoalTaskEventType: string {
    case CreateTask = 'new task';
    case UpdateTask = 'update task';
    case SoftDeleteTask = 'soft delete task';
    case HardDeleteTask = 'delete task';
    case AssignTask = 'assign task';
    case CompleteTask = 'complete task';
    case AddComment = 'add comment';
    case UpdateComment = 'update comment';
    case DeleteComment = 'delete comment';
}