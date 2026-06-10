        @extends('layouts.carer')

        @section('title', 'Viewing Tasks for Carer - add name')

        @section('carer-content')

            <x-shared.header
                :headline="'Viewing Tasks for ' . $carer->user->first_name . ' at ' . $home->home_name . '.' "
                :sub-headline="$carer->user->first_name . ' here are your tasks at ' . $home->home_name"
            >
            </x-shared.header>

            <x-task.select-bar
                :filter-types="$filter_types"
                :filter-selected="$filter_selected"
                :client-selected-id="$client_selected"
                :all-home-clients="$home->clients"
                :home-name="$home->home_name"
                :route="route('carer.view-tasks', ['org_id' => $org_id, 'home_id' => $home->id])">
            </x-task.select-bar>

            @php
                $newSortDir = $sort_dir === 'asc' ? 'desc' : 'asc';
                $baseParams =  
                    [
                        'org_id' => $org_id, 
                        'home_id' => $home->id,
                        'filterType' => $filter_selected,
                        'client' => $client_selected,
                        'sortDir' => $newSortDir
                    ];
                $sortClassToAdd = $sort_dir === 'asc' ? 'pd-sort-ascending' : 'pd-sort-descending';
            @endphp

            <div class="bg-white border rounded p-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Task Title</th>
                            <th class="d-none d-md-table-cell" scope="col">Goal Name</th>
                            <th class="d-none d-md-table-cell" scope="col">Client</th>
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('carer.view-tasks', array_merge($baseParams, ['sortBy' => 'due_at'])) }}">Due At</a></th>
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('carer.view-tasks', array_merge($baseParams, ['sortBy' => 'priority'])) }}">Priority</a></th>
                            <th scope="col">Days To Go</th>
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('carer.view-tasks', array_merge($baseParams, ['sortBy' => 'goal_task_status'])) }}">Task Status</a></th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->title }}</th>
                            <td class="d-none d-md-table-cell">{{ $task->goal->title }}</td>
                            <td class="d-none d-md-table-cell">{{ $task->goal->client->user->full_name }}</td>
                            <td class="d-none d-md-table-cell">{{ $task->due_at->format('j M Y') }}</td>
                            <td class="d-none d-md-table-cell text-capitalize">{{ $task->priority }}</td>
                            <td>
                                <x-task.days-to-go :due-at="$task->due_at"></x-task.days-to-go>
                            </td>
                            <td class="d-none d-md-table-cell text-capitalize">{{ $task->goal_task_status }}</td>
                            <td>
                                <a href="#" class="btn btn-secondary btn-sm">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th>There are no tasks to display</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @endforelse
                        
                    </tbody>

                </table>
            </div>

        @endsection