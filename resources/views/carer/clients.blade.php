        @extends('layouts.carer')

        @section('title', 'Clients at ' . $home->home_name)

        @section('carer-content')

            <x-shared.header
                :headline="'All Clients at ' . $home->home_name"
                :sub-headline="'Viewing all active clients at ' . $home->home_name"
            >
            </x-shared.header>

            <x-shared.list-clients
                :clients="$home->clients"
                :home="$home"
                :org-id="$org_id"
                :is-card="false"
                role="carer"
            ></x-shared.list-clients>


        @endsection