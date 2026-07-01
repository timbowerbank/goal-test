    @extends('layouts.organisation')

    @section('title', 'Organisation Dashboard')

    @section('organisation-content')
    <x-shared.header
        :headline="'Dashboard for: ' . $organisation->organisation_name"
        :sub-headline="'Welcome to the administration portal for J-Goal at ' . $organisation->organisation_name"
    ></x-shared.header>

    <div class="row">
        <div class="col">
            <x-goal.card-metric-count-goals
                headline="Latest Goal Statistics"
                :goals="$goals"
                button-url="{{ route('organisation-admin.view-goals', ['org_id' => $organisation->id]) }}"
            ></x-goal.card-metric-count-goals>

        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <x-shared.card-metric-simple
                headline="Total Active Homes"
                :metric="$homeCount"
                button-url="{{ route('organisation-admin.view-homes', ['org_id' => $organisation->id]) }}"
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

    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection