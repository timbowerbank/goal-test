        @extends('layouts.manager')

        @section('title', 'Manager Dashboard')

        @section('manager-content')
        <x-shared.header headline="Manager Dashboard" sub-headline="Welcome to J-Goal"></x-shared.header>

        <x-shared.list-homes :homes="$homes" :is-manager="$is_manager"></x-shared.list-homes>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection