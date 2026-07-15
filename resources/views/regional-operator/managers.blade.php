            @extends('layouts.regional-operator')

            @section('title', 'Viewing all managers for region...')

            @section('regional-operator-content')
                <x-shared.header
                    :headline="'Viewing Managers For ' . $region->name"
                    :sub-headline="'You are viewing all active managers in the ' . $region->name . ' region.'"
                ></x-shared.header>

                <x-shared.list-managers
                    :managers="$managers"
                    home=""
                    headline=""
                    :has-headline="false"
                    :org-id="$org_id"
                    :is-card="false"
                    role="regional-operator"
                ></x-shared.list-managers>


            @endsection