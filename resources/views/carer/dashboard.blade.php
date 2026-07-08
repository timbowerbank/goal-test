        @extends('layouts.carer')       
        
        @section('title', 'Carer Dashboard')

        @section('carer-content')
        <x-shared.header 
                :headline="$carer->user->first_name . '\'s Dashboard'" 
                :sub-headline="'Welcome ' . $carer->user->first_name .  ' to J-Goal at ' . $organisation->organisation_name . '.'">
        </x-shared.header>

        <x-shared.list-homes 
                :homes="$homes" 
                headline="My Homes"
                :org-id="$organisation->id"
                role="carer"
                :has-footer-button="true">
        </x-shared.list-homes>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection

        

