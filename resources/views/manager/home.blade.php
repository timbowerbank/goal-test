        @extends('layouts.manager')

        @section('title', $home->home_name)

        @section('manager-content')
        <x-shared.header headline="{{ $home->home_name }}" sub-headline="See clients and carers for {{ $home->home_name }}"></x-shared.header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection