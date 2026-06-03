@props([
    'headline',
    'tasks',
    'is-card',
    'org-id',
    'home-id',
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    @if($tasks)
        <table class="w-100 table table-striped">
            <thead>
                <tr>
                    <th scope="row">Task Title</th>
                    <th class="d-none d-md-table-cell">Task Description</th>
                    <th class="d-none d-md-table-cell">Assigned To</th>
                    <th class="d-none d-md-table-cell">Goal Task Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td scope="row">
                        {{ $task->title }}
                    </td>
                    <td class="d-none d-md-table-cell">
                        {{ $task->description }}
                    </td>
                    <td class="d-none d-md-table-cell">
                        {{ $task->assignedTo->full_name }}
                    </td>
                    <td class="d-none d-md-table-cell">
                        {{ $task->goal_task_status }}
                    </td>
                    <td>
                        <a href="{{ route('manager.view-task-for-goal', [
                            'org_id' => $orgId, 
                            'home_id' => $homeId,
                            'client_id' => $task->goal->client->id,
                            'goal_id' => $task->goal->id,
                            'task_id' => $task->id,
                            
                            ]) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    @else
    <p>No tasks set.</p>

    @endif

</div>