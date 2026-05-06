    @extends('layouts.manager')

    @section('title', $carer->user->full_name)

    @section('manager-content')
    <x-shared.header 
        :headline="'Viewing Carer: ' . $carer->user->full_name" 
        :sub-headline="'Welcome to ' . $carer->user->first_name . '\'s Dashboard.'"></x-shared.header>


    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection