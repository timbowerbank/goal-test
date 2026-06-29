        @extends('layouts.client')

        @section('title', 'title tage for view task')

        @section('client-content')
            <x-shared.header
                :headline="'Viewing Task: ' . $task->title"
                :sub-headline="'Currently viewing task for goal: ' . $goal->title"
            ></x-shared.header>

            <div class="row">
                <div class="col-md-6">
                    <x-task.task-summary-card
                        :task="$task"
                        :org-id="$org_id"
                        :home-id="$home->id"
                        role="client"
                    ></x-task.task-summary-card>

                </div>

                <div class="col-md-6">
                    <x-task.list-comments
                        :comments="$task->comments"
                    ></x-task.list-comments>
                    
                </div>

            </div>

        @endsection