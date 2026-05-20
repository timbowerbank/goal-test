<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\GoalTask;
use Carbon\Carbon;
use App\Enums\TaskStatus;

class TaskSummaryCard extends Component
{
    public int $daysToGo = 0;
    public bool $isLate = false;
    public bool $isComplete = false;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public GoalTask $task,
        public string $orgId,
        public string $homeId,
        )
    {
        $this->isComplete = $task->goal_task_status === TaskStatus::Complete;

        $now = Carbon::now();
        $dueAt = $this->task->due_at;

        if ($dueAt) {
            $this->isLate = $now->isAfter($dueAt);
            $this->daysToGo = (int) $now->diffInDays($dueAt, absolute: true);
        } else {
            $this->isLate = false;
            $this->daysToGo = 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-summary-card');
    }
}
