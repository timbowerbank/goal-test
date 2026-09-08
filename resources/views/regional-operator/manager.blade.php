        @extends('layouts.regional-operator')

        @section('title', 'Viewing Manager')

        @section('regional-operator-content')

            <x-shared.header
                :headline="'Viewing Manager: ' . $manager->user->full_name"
                :sub-headline="'You are viewing active manager: ' . $manager->user->full_name"
            ></x-shared.header>

            <x-shared.list-homes
                :homes="$manager->homes"
                :headline="'Homes managed by ' . $manager->user->first_name"
                :org-id="$org_id"
                role="regional-operator"
                :has-footer-button="false"
            ></x-shared.list-homes>


        @endsection