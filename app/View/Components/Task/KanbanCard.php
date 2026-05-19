<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\GoalTask;
use Carbon\Carbon;

class KanbanCard extends Component
{
    public int $daysToGo = 0;
    public bool $isLate = false;


    /**
     * Create a new component instance.
     */
    public function __construct(
        public GoalTask $task, public bool $isCompleted, public string $viewTaskUrl
    )
    {
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
        return view('components.task.kanban-card');
    }
}
