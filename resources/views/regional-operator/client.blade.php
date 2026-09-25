            @extends('layouts.regional-operator')

            @section('title', 'Viewing client')

            @section('regional-operator-content')

                <x-shared.header
                    :headline="'Viewing client: ' . $client->user->full_name"
                    :sub-headline="'You are viewing ' . $client->user->full_name"
                ></x-shared.header>

                <x-shared.list-goals
                    :headline="'Goals for ' . $client->user->first_name"
                    :goals="$client->goals"
                    :has-headline="true"
                    :org-id="$org_id"
                    :home-id="$client->home_id"
                    :region-id="$region->id"
                    :client-id="$client->id"
                    role="regional-operator"
                    :has-footer-button="false"
                ></x-shared.list-goals>

            @endsection