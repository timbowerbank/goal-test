        @extends('layouts.client')
        
        @section('title', 'Client Dashboard')

        @section('client-content')
            
            <x-shared.header
                :headline="'Welcome ' . $client->user->first_name . ' to your dashboard'"
                :sub-headline="'Below are your goals and tasks at ' . $client->home->home_name . '.'">
            </x-shared.header>

            <x-shared.list-goals
                :headline="'Goals for ' . $client->user->first_name"
                :goals="$goals"
                :has-headline="true"
                :org-id="$org_id"
                home-id=""
                :client-id="$client->id"
                role="client"

            ></x-shared.list-goals>

            <x-shared.list-tasks
                :headline="'Tasks for ' . $client->user->first_name"
                :tasks="$tasks"
                :is-card="false"
                :org-id="$org_id"
                home-id=""
                role="client"
            >
            </x-shared.list-tasks>

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>
        @endsection

