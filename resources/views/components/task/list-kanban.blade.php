@props([
    'headline',
    'not-started-tasks',
    'in-progress-tasks',
    'complete-tasks'
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    <div class="row">
        <div class="col-md-4 mb-2">
            <h3>Not Started</h3>
            @foreach($notStartedTasks as $notStartedTask)

            <x-task.kanban-card
                :task="$notStartedTask">
            </x-task.kanban-card>

            @endforeach
        </div>
        <div class="col-md-4 mb-2">
            <h3>In Progress</h3>
            @foreach($inProgressTasks as $inProgressTask)

            <x-task.kanban-card
                :task="$inProgressTask">
            </x-task.kanban-card>

            @endforeach
        </div>
        <div class="col-md-4 mb-2">
            <h3>Complete</h3>
            @foreach($completeTasks as $completeTask)

            <x-task.kanban-card
                :task="$completeTask">
            </x-task.kanban-card>

            @endforeach
        </div>
        
    </div>

</div>