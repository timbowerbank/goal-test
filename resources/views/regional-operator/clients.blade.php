        @extends('layouts.regional-operator')

        @section('title', 'Viewing Clients for region')

        @section('regional-operator-content')

        <x-shared.header
            :headline="'Viewing ' . $region->name . ' clients.'"
            :sub-headline="'You are viewing all clients for the region: ' . $region->name . '.'"
        ></x-shared.header>

        <x-shared.list-clients
            :clients="$clients"
            home=""
            headline=""
            :has-headline="false"
            :org-id="$org_id"
            :is-card="false"
            role="regional-operator"
        ></x-shared.list-clients>

        @endsection