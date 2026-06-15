        @extends('layouts.manager')

        @section('title', "Tasks for add carer name")

        @section('manager-content')

        <x-shared.header 
        :headline="'Viewing Task: ' . $task->title" 
        :sub-headline="'This task is assigned to: ' . $task->assignedTo->full_name"></x-shared.header>

        <div class="row">
                <div class="col">
                        <x-task.task-summary-card
                                :task="$task"
                                :org-id="$org_id"
                                :home-id="$home_id"
                                role="manager">
                        </x-shared.task.task-summary-card>
                </div>
                <div class="col">
                        <x-task.list-comments
                                :comments="$task->comments"
                        ></x-task.list-comments>

                        
                </div>
        </div>

        @endsection