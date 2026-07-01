        @extends('layouts.organisation')

        @section('title', 'Viewing homes at...')

        @section('organisation-content')
            <x-shared.header
                :headline="'All homes at: ' . $organisation->organisation_name"
                :sub-headline="'Viewing all active homes at ' . $organisation->organisation_name"
            ></x-shared.header>

            <x-shared.list-homes
                :homes="$homes"
                :org-id="$organisation->id"
                role="organisation-administrator"
                :has-footer-button="false"
            ></x-shared.list-homes>


        @endsection