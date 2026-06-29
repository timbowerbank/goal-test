        @extends('layouts.client')

        @section('title', 'Viewing All Tasks for ' . $client->user->full_name)

        @section('client-content')

            <x-shared.header
                :headline="'Viewing all tasks for: ' . $client->user->full_name"
                :sub-headline="'Viewing all In Progress or Not started tasks for ' . $client->user->first_name"
            ></x-shared.header>

            <x-shared.list-tasks
                headline=""
                :tasks="$tasks"
                :is-card="false"
                :org-id="$org_id"
                home-id=""
                role="client"
                :has-footer-button="false"
            ></x-shared.list-tasks>

        @endsection
