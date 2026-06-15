        @extends('layouts.carer')

        @section('title', 'Viewing Task')

        @section('carer-content')
            <x-shared.header
                headline="Viewing Task"
                sub-headline="This is a task for..."
                >
            </x-shared.header>

            <div class="row">
                <div class="col-md-6">
                    <x-task.task-summary-card
                        :task="$task"
                        :org-id="$org_id"
                        :home-id="$home_id"
                        role="carer"
                        >
                    </x-task.task-summary-card>
                </div>

                <div class="col-md-6">
                    <x-task.list-comments
                        :comments="$task->comments"
                        >
                    </x-task.list-comments>

                </div>
            </div>

        @endsection