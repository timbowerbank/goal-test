    @extends('layouts.organisation')

    @section('title', 'Organisation Dashboard')

    @section('organisation-content')
    <x-shared.header
        :headline="'Active clients: ' . $clientCount"
        sub-headline="This is for organisation admins only"
    ></x-shared.header>

    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection