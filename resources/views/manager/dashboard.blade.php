        @extends('layouts.manager')

        @section('title', 'Manager Dashboard')

        @section('manager-content')
        <x-shared.header 
                :headline="$user->first_name . '\'s Dashboard'" 
                :sub-headline="'Welcome ' . $user->first_name . ' to J-Goal at '  . $organisation->organisation_name"></x-shared.header>

        <x-shared.list-homes 
                :homes="$homes" 
                :org-id="$org_id"
                role="manager"
                :has-footer-button="true"></x-shared.list-homes>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection