        @extends('layouts.organisation')

        @section('title', 'Viewing Manager')

        @section('organisation-content')
            <x-shared.header
                :headline="'Viewing Manager: ' . $manager->user->full_name"
                :sub-headline="'You are currently viewing active manager ' . $manager->user->full_name"
            ></x-shared.header>

            <x-shared.staff-summary-card
                :staff-member="$manager"
            ></x-shared.staff-summary-card>

            <x-shared.list-homes
                :homes="$manager->homes"
                headline="Managing Homes"
                :org-id="$org_id"
                role="organisation-administrator"
                :has-footer-button="false"
            ></x-shared.list-homes>

            {{-- add new <x-shared.staff-metrics-card></x-shared.staff-metrics-card> --}}


        @endsection