        @extends('layouts.manager')

        @section('title', 'Clients at: ' . $home->home_name)

        @section('manager-content')
        
        <x-shared.header 
                :headline="$home->home_name . ' Clients'"
                :sub-headline="'Viewing all clients at ' . $home->home_name"></x-shared.header>

        <x-shared.list-clients :clients="$home->clients" :home="$home" :org-id="$org_id" :is-card="false"></x-shared.list-clients>

        
        @endsection