        @extends('layouts.regional-operator')

        @section('title', 'Regional Operator Dashboard')

        @section('regional-operator-content')
        <x-shared.header 
                headline="Regional operator Dashboard" 
                sub-headline="You are logged in as a regional operator"></x-shared.header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection