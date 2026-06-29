<div class="p-4 rounded border bg-white">
    <header>
        <h2>Summary</h2>
        @if($isComplete)
            @if($task->completed_at)
            <p>Completed: {{ $task->completed_at->format('j M Y') }}</p>
            @endif
            <p>Completed with {{ $task->completedWith->full_name }}</p>
        @else
            @if($isLate)
                <p><strong>Late by: {{ $daysToGo }} days</strong></p>
            @else
                <p><strong>Due in: {{ $daysToGo }} days</strong></p>
            @endif
            <p><strong>Status: {{ $task->goal_task_status }}</strong></p>
        @endif
    </header>
    
    <table class="table">
        <tr>
            <th>Title</th>
            <td>{{ $task->title }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $task->description }}</td>
        </tr>
        <tr>
            <th>Due on: </th>
            <td>{{ $task->due_at->format('j M Y') }}</td>
        </tr>
        <tr>
            <th>Status: </th>
            <td>{{ $task->goal_task_status }}</td>
        </tr>
        <tr>
            <th>Goal: </th>
            <td>
                @if($role === 'manager')
                <a href="{{ route('manager.view-goal', 
                [
                    'org_id' => $orgId, 
                    'home_id' => $homeId, 
                    'client_id' => $task->goal->client->id, 
                    'goal_id' => $task->goal->id
                ]) }}"
                    >
                    {{ $task->goal->title }}
                </a>
                @elseif($role === 'carer') 

                <a href="{{ route('carer.view-goal', 
                    [
                        'org_id' => $orgId, 
                        'home_id' => $homeId, 
                        'client_id' => $task->goal->client->id, 
                        'goal_id' => $task->goal->id
                        
                    ]) }}">
                    {{ $task->goal->title }}
                </a>
                @elseif($role === 'client')

                    <a href="{{ route('client.view-goal', [
                        'org_id' => $orgId, 
                        'goal_id' => $task->goal->id
                        ]) }}">{{ $task->goal->title }}</a>
                @endif
            </td>
        </tr>
        <tr>
            <th>
                @if($role === 'client')
                Assigned To:    
                @else
                Client:
                @endif
            </th>
            <td>
                @if($role === 'manager')
                <a href="{{ route('manager.view-client', 
                [
                    'org_id' => $orgId,
                    'home_id' => $homeId,
                    'client_id' => $task->goal->client->id,
                
                ]) }}"
                >
                    {{ $task->goal->client->user->full_name }}
                </a>
                @elseif($role === 'carer')
                <a href="{{ route('carer.view-client', 
                    [
                        'org_id' => $orgId,
                        'home_id' => $homeId,
                        'client_id' => $task->goal->client->id,
                    
                    ]) }}">
                    {{ $task->goal->client->user->full_name }}
                </a>
                @elseif($role === 'client')
                    {{ $task->assignedTo->full_name }}
                @endif
            </td>


        </tr>
    </table>

</div>