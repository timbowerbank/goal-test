<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class DaysToGo extends Component
{
    public int $daysToGo = 0;
    public bool $isLate = false;
    /**
     * Create a new component instance.
     */
    public function __construct(Carbon $dueAt)
    {
        $this->calcDaysToGo($dueAt);
    }

    public function calcDaysToGo(Carbon $date) {
        $now = Carbon::now();
        $dueAt = $date;

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
        return view('components.task.days-to-go');
    }
}
