        @extends('layouts.regional-operator')

        @section('title', 'Viewing all carers for the region')

        @section('regional-operator-content')

            <x-shared.header
                :headline="'Viewing ' . $region->name . ' Carers'"
                :sub-headline="'You are viewing all active carers for the ' . $region->name . ' region.'"
            ></x-shared.header>

            <x-shared.list-carers
                :carers="$carers"
                home=""
                headline=""
                :has-headline="false"
                :org-id="$org_id"
                :region-id="$region->id"
                :is-card="false"
                role="regional-operator"
            
            ></x-shared.list-carers>

        @endsection