@props([
    'tasks',
    'is-card'
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>Goal Tasks</h2>
    </header>
    @if($tasks)
        <table class="w-100 table table-striped">
            <thead>
                <tr>
                    <th scope="row">Task Title</th>
                    <th>Task Description</th>
                    <th>Assigned To</th>
                    <th>Goal Task Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td scope="row">
                        {{ $task->title }}
                    </td>
                    <td>
                        {{ $task->description }}
                    </td>
                    <td>
                        {{ $task->assignedTo->full_name }}
                    </td>
                    <td>
                        {{ $task->goal_task_status }}
                    </td>
                    <td>
                        <a href="#" class="btn btn-secondary btn-sm">View</a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    @else
    <p>No tasks set.</p>

    @endif

</div>