        @extends('layouts.client')
        
        @section('title', 'Client Dashboard')

        @section('client-content')
            
            <x-shared.header
                headline="Welcome to the Client Dashboard"
                sub-headline="This is the client dashboard for...">
            </x-shared.header>

            {{-- <x-shared.list-goals></x-shared.list-goals>
            <x-shared.list-tasks></x-shared.list-tasks> --}}

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>
        @endsection

