            @extends('layouts.regional-operator')

            @section('title', 'Viewing Homes for region...')

            @section('regional-operator-content')
                <x-shared.header
                    :headline="'Viewing Homes in Region: ' . $region->name"
                    :sub-headline="'All active homes in ' . $region->name . '.'"
                ></x-shared.header>

                <x-shared.list-homes
                    :homes="$region->homes"
                    headline="Active Homes"
                    :org-id="$org_id"
                    role="regional-operator"
                    :has-footer-button="false"
                ></x-shared.list-homes>


            @endsection