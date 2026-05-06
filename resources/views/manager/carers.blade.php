        @extends('layouts.manager')

        @section('title', 'Carers at: ' . $home->home_name)

        @section('manager-content')
        
        <x-shared.header 
                :headline="$home->home_name . ' Carers'"
                :sub-headline="'Viewing all carers at ' . $home->home_name"></x-shared.header>

        {{-- <x-shared.list-clients :clients="$home->clients" :home="$home" :org-id="$org_id" :is-card="false"></x-shared.list-clients> --}}

        <x-shared.list-carers
            :carers="$home->carers"
            :home="$home"
            :org-id="$org_id"
            :is-card="false"></x-shared.list-carers>

        
        @endsection