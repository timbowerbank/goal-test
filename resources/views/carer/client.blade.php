        @extends('layouts.carer')

        @section('title', 'Viewing client: ' . $client->user->full_name)

        @section('carer-content')

            <x-shared.header
                :headline="'Viewing Client: ' . $client->user->full_name"
                :sub-headline="'You are viewing ' . $client->user->first_name . '\'s Dashboard.'"
            >
            </x-shared.header>

            <!-- Add in a list of goals -->
            <x-shared.list-goals
                :headline="'Goals for ' . $client->user->first_name"
                :goals="$client->goals"
                :has-headline="false"
                :org-id="$org_id"
                :home-id="$home_id"
                :client-id="$client->id"
                role="carer"
                :has-footer-button="true"
            ></x-shared.list-goals>

            <!-- Add in a list of carer tasks -->
            <x-shared.list-tasks
                :headline="'Your tasks for: ' . $client->user->first_name"
                :tasks="$tasks"
                :is-card="false"
                :org-id="$org_id"
                :home-id="$home_id"
                role="carer"
                :has-footer-button="false"
            ></x-shared.list-tasks>


        @endsection