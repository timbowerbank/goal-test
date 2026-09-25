        @extends('layouts.regional-operator')

        @section('title', 'Viewing task')

        @section('regional-operator-content')
                
            <x-shared.header
                :headline="'Viewing Task: ' . $task->title"
                :sub-headline="'You are viewing task ' . $task->title . ' for client ' . $task->goal->client->user->full_name . '.'"
            ></x-shared.header>          
            
            

            <div class="row">
                <div class="col-md-6">
                    
                    <x-task.task-summary-card
                        :task="$task"
                        :org-id="$org_id"
                        :home-id="$task->goal->home->id"
                        role="regional-operator"
                    ></x-task.task-summary-card>
                    

                </div>

                <div class="col-md-6">
                    
                    <x-task.list-comments
                        :comments="$task->comments"
                        >
                    </x-task.list-comments>


                </div>

            </div>

        @endsection