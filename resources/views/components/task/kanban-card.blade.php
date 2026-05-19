<div class="border rounded p-4 mb-2 @if($isLate) border-danger bg-light @endif">
    <div class="row">
        <div class="col">
            <p class="fs-6 mb-0"><strong>
                @if(!$isCompleted)
                Due:
                @else
                Was Due:
                @endif
            
                </strong></p>
            <p>{{ $task->due_at->format('j F Y') }}</p>
        </div>
        <div class="col">
            <p class="fs-6 mb-0">
                <strong>
                @if(!$isCompleted)
                    @if($isLate)
                        @if($daysToGo > 1) 
                        <span class="text-danger">{{ $daysToGo }} days overdue</span>
                        @else
                        <span class="text-danger">{{ $daysToGo }} day overdue</span>
                        @endif

                    @else

                        @if($daysToGo > 1) 
                        <span class="text-success">{{ $daysToGo }} days to go</span>
                        @else
                        <span class="text-success">{{ $daysToGo }} day to go</span>
                        @endif

                    @endif
                @endif
                </strong></p>
        </div>
    </div>
    <header>
        {{-- <p class="fs-6 mb-0"><strong>Task Title:</strong></p> --}}
        <h4>{{ $task->title }}</h4>
    </header>
    <hr>
    <div class="row">
        <div class="col">
            <p class="fs-6 mb-0"><strong>For:</strong></p>
            <p>{{ $task->goal->client->user->full_name }}</p>
        </div>
        <div class="col">
            <p class="fs-6 mb-0"><strong>Goal:</strong></p>
            <p>{{ $task->goal->title }}</p>
        </div>
    </div>
    <footer>
        <a href="#" class="btn btn-secondary btn-sm">View Task</a>
    </footer>
</div>