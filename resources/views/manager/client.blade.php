        @extends('layouts.manager')

        @section('title', $client->user->full_name)

        @section('manager-content')
     
        <x-shared.header 
                :headline="'Viewing ' . $client->user->full_name" 
                :sub-headline="'Welcome to ' . $client->user->first_name . '\'s Dashboard.'">
        </x-shared.header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection