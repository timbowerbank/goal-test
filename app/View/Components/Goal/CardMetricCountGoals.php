<?php

namespace App\View\Components\Goal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\Enums\GoalStatus;


class CardMetricCountGoals extends Component
{

    public int $totalActiveGoals = 0;
    public int $totalOverdueGoals = 0;
    public int $totalNewGoalsThisMonth = 0;
    public Carbon $now;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $headline,
        public Collection $goals
        )
    {
        $this->totalOverdueGoals = $this->calcOverdueGoals($goals);
        $this->totalNewGoalsThisMonth = $this->calcNewGoalsThisMonth($goals);
        $this->totalActiveGoals = $goals->count();

        $this->now = now();

    }


    private function calcOverdueGoals(Collection $goals):int {

        return $goals->where('achieve_by', '<', now())->count();
    }

    private function calcNewGoalsThisMonth(Collection $goals):int {

        $now = now();
        $start = $now->copy()->startOfMonth(); 
        $end = $now;

        return $goals->whereBetween('created_at', [$start, $end])
            ->where('goal_status', GoalStatus::Active)
            ->count();

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.goal.card-metric-count-goals');
    }
}
