        @extends('layouts.manager')

        @section('title', $client->user->full_name)

        @section('manager-content')
     
        <x-shared.header 
                :headline="'Viewing ' . $client->user->full_name" 
                :sub-headline="'Welcome to ' . $client->user->first_name . '\'s Dashboard.'">
        </x-shared.header>

        <x-shared.list-goals
                :goals="$client->goals"
                :is-card="true"
                :org-id="$org_id"
                :home-id="$home_id"
                :client-id="$client->id"
                role="manager"
        ></x-shared.list-goals>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection