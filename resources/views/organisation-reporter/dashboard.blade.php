        @extends('layouts.organisation-reporter')

        @section('title', 'Organisation Reporter Dashboard')

        @section('manager-content')
        <x-shared.header 
                headline="Organisation Reporter Dashboard" 
                sub-headline="You are logged in as an organisation reporter"></x-shared.header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection