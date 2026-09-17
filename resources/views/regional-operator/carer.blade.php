            @extends('layouts.regional-operator')

            @section('title', 'Viewing Carer')

            @section('regional-operator-content')

                <x-shared.header
                    :headline="'Viewing Carer: ' . $carer->user->full_name"
                    :sub-headline="'You are viewing the carer ' . $carer->user->full_name"
                ></x-shared.header>

                <div class="bg-white border w-100 p-4 mb-4">

                    <!-- Select row -->
                    <div class="row">
                        
                        <!-- dropdown col -->
                        <div class="col-md-6">
                            <div>
                                <form class="d-flex flex-row align-items-center justify-content-start" method="get" action="{{ route('regional-operator.view-carer', ['org_id' => $org_id, 'region_id' => $region->id, 'carer_id' => $carer->id]) }}">
                                    @csrf
                                    <p class="mb-md-0 me-3"><strong>Filter</strong></p>
                                    
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <select name="filterType" class="form-select mb-2 mb-md-0" aria-label="Default select example">
                                            @php
                                                $filterLabels = ['all' => 'All tasks', 'due' => 'Due this week', 'overdue' => 'Overdue tasks'];
                                            @endphp
                                            @foreach($filter_types as $filter)
                                                <option value="{{ $filter }}" {{ $filter_selected === $filter ? 'selected' : '' }}>{{ $filterLabels[$filter] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary ms-3">Go</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- -->

                </div>

                @php
                    $newSortDir = $sort_dir === 'asc' ? 'desc' : 'asc';
                    $baseParams =  
                        [
                            'org_id' => $org_id, 
                            'region_id' => $region->id,
                            'carer_id' => $carer->id,
                            'filterType' => $filter_selected,
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
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('regional-operator.view-carer', array_merge($baseParams, ['sortBy' => 'due_at'])) }}">Due At</a></th>
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('regional-operator.view-carer', array_merge($baseParams, ['sortBy' => 'priority'])) }}">Priority</a></th>
                            <th scope="col">Days To Go</th>
                            <th class="d-none d-md-table-cell" scope="col"><a class="{{ $sortClassToAdd }} text-decoration-none text-dark position-relative" href="{{ route('regional-operator.view-carer', array_merge($baseParams, ['sortBy' => 'goal_task_status'])) }}">Task Status</a></th>
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
                                <a href="{{ route('regional-operator.view-task', ['org_id' => $org_id, 'region_id' => $region->id, 'carer_id' => $carer->id, 'task_id' => $task->id]) }}" class="btn btn-secondary btn-sm">View</a>
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