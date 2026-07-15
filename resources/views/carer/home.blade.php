    @extends('layouts.carer')

    @section('title', "$home->home_name")

    @section('carer-content')

        <x-shared.header
            :headline="$home->home_name"
            :sub-headline="'Welcome to ' . $home->home_name"
        ></x-shared.header>

        <div class="row">
            <div class="col-md-6">
                <x-task.task-stats-card
                    :tasks="$carer->tasks"
                    :org-id="$org_id"
                    :home-id="$home_id">
            </x-task.task-stats-card>
                        
            </div>

            <div class="col-md-6">
                <x-shared.list-clients
                    :clients="$home->clients"
                    :headline="'Clients at ' . $home->home_name"
                    :has-headline="true"
                    :home="$home"
                    :org-id="$org_id"
                    :is-card="true"
                    role="carer"
                ></x-shared.list-clients>

            </div>
        </div>

    @endsection