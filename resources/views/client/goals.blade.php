        @extends('layouts.client')

        @section('title', 'Viewing all goals for ' . $client->user->full_name)

        @section('client-content')
            <x-shared.header
                :headline="'Viewing goals for: ' . $client->user->full_name"
                :sub-headline="'You are viewing all goals for: ' . $client->user->first_name"
            ></x-shared.header>

        <x-shared.list-goals
            headline=""
            :goals="$client->goals"
            :has-headline="false"
            :org-id="$org_id"
            home-id=""
            client-id=""
            role="client"
            :has-footer-button="false"
        ></x-shared.list-goals>

        @endsection