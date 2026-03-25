        @extends('layouts.carer')       
        
        @section('title', 'Carer Dashboard')

        @section('carer-content')
        <x-shared.header 
                headline="Carer Dashboard: Welcome" 
                sub-headline="Welcome to J-Goal, as a carer you can help your client achieve their goals">
        </x-header>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection

        

