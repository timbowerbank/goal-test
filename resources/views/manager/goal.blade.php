        @extends('layouts.manager')

        @section('title', 'Goal Title holder')

        @section('manager-content')
        <x-shared.header
            headline="View Goal"
            sub-headline="Viewing Goal for [add name]">
        </x-shared.header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection