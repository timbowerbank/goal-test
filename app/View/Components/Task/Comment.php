<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\GoalTaskComment;
use Carbon\Carbon;

class Comment extends Component
{
    public int $daysSince = 0;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public GoalTaskComment $comment
    )
    {
        $now = Carbon::now();
        $this->daysSince = (int) $now->diffInDays($comment->created_at, absolute: true);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.comment');
    }
}
