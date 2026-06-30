    @extends('layouts.organisation')

    @section('title', 'Organisation Dashboard')

    @section('organisation-content')
    <x-shared.header
        headline="Org Admin Dashboard"
        sub-headline="This is for organisation admins only"
    ></x-shared.header>

    <div class="row">
        <div class="col">
            <x-goal.card-metric-count-goals
                headline="Latest Goal Data"
                :goals="$goals"
            ></x-goal.card-metric-count-goals>

        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <x-shared.card-metric-simple
                headline="Total Active Homes"
                :metric="$homeCount"
                button-url="#"
                button-label="View All Homes"
            ></x-shared.card-metric-simple>
        </div>

        <div class="col-md-6">
            <x-shared.card-metric-simple
                headline="Total Active Clients"
                :metric="$clientCount"
                button-url="#"
                button-label="View All Clients"
            ></x-shared.card-metric-simple>
        </div>

        <div class="col-md-6">
            <x-shared.card-metric-simple
                headline="Total Active Managers"
                :metric="$managerCount"
                button-url="#"
                button-label="View All Managers"
            ></x-shared.card-metric-simple>
        </div>

        <div class="col-md-6">
            <x-shared.card-metric-simple
                headline="Total Active Carers"
                :metric="$carerCount"
                button-url="#"
                button-label="View All Carers"
            ></x-shared.card-metric-simple>
        </div>
    </div>



    

    {{-- 

        Add in... 
        
    
        <x-shared.card-metric-count></x-shared.card-metric-count>
    
    --}}

    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection