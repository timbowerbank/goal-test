<?php

namespace App\View\Components\task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TaskSummary extends Component
{
    public int $overdueTasks = 0;
    public int $dueThisWeek = 0;
    /**
     * Create a new component instance.
     */
    public function __construct(public Collection $tasks)
    {
        $this->sortTasks($tasks);
    }

    // *** sortTasks() ***
    private function sortTasks(Collection $tasks) {
        $this->overdueTasks = $tasks->where('due_at', '<', now())->count();
        $this->dueThisWeek = $tasks->where('due_at', [now(), now()->endOfWeek()])->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.task-summary');
    }
}
