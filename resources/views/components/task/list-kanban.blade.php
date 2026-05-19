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
        <div class="col-lg-4 mb-2">
            <h3>Not Started</h3>
                @forelse($notStartedTasks as $notStartedTask)

                <x-task.kanban-card
                    :task="$notStartedTask"
                    :is-completed="false">
                </x-task.kanban-card>

                @empty
                <p>No tasks present</p>

                @endforelse
        </div>
        <div class="col-lg-4 mb-2">
            <h3>In Progress</h3>
            @forelse($inProgressTasks as $inProgressTask)

            <x-task.kanban-card
                :task="$inProgressTask"
                :is-completed="false">
            </x-task.kanban-card>

            @empty
            <p>No tasks present</p>

            @endforelse
        </div>
        <div class="col-lg-4 mb-2">
            <h3>Complete</h3>
            @forelse($completeTasks as $completeTask)

            <x-task.kanban-card
                :task="$completeTask"
                :is-completed="true">
            </x-task.kanban-card>

            @empty
            <p>No tasks present</p>

            @endforelse
        </div>
        
    </div>

</div>