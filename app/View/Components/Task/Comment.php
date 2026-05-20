<?php

namespace App\View\Components\Task;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\GoalTaskComment;

class Comment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public GoalTaskComment $comment
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task.comment');
    }
}
