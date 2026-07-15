        @extends('layouts.regional-operator')

        @section('title', 'Viewing home...')


        @section('regional-operator-content')
            <x-shared.header
                :headline="'Viewing ' . $home->home_name"
                :sub-headline="'You are viewing ' . $home->home_name . ' in region ' . $region->name . '.'"
            ></x-shared.header>


            <x-home.summary
                :home="$home"
            ></x-home.summary>

            <x-goal.card-metric-count-goals
                headline="Goal Stats"
                :goals="$goals"
                button-url="#"
            ></x-goal.card-metric-count-goals>

            <x-shared.list-managers
                :managers="$home->managers"
                :home="$home"
                :headline="'Managers at ' . $home->home_name"
                :has-headline="true"
                :org-id="$org_id"
                :is-card="false"
                role="regional-operator"
            ></x-shared.list-managers>

            <x-shared.list-carers
                :carers="$home->carers"
                :home="$home"
                :headline="'Carers at ' . $home->home_name"
                :has-headline="true"
                :org-id="$org_id"
                :is-card="false"
                role="regional-operator"            
            ></x-shared.list-carers>

            <x-shared.list-clients
                :clients="$home->clients"
                :home="$home"
                :headline="'Clients at ' . $home->home_name"
                :has-headline="true"
                :org-id="$org_id"
                :is-card="false"
                role="regional-operator"


            ></x-shared.list-clients>

        @endsection