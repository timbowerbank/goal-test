        @extends('layouts.organisation-reporter')

        @section('title', 'Organisation Reporter Dashboard')

        @section('organisation-reporter-content')
        <x-shared.header 
                :headline="'Reporter Dashboard for ' . $organisation->organisation_name" 
                sub-headline="You are logged in as an organisation reporter"></x-shared.header>


        <div class="row">
                <div class="col-12">
                    <x-goal.card-metric-count-goals
                        :headline="'Goal Stats for: ' . $organisation->organisation_name"
                        :goals="$goals"
                        button-url="#"
                    />
                </div>
        </div>

        <div class="row">
                <div class="col-12">
                        <x-shared.list-regions
                        :regions="$regions"
                        :org-id="$organisation->id"
                        headline="Regions"
                        :has-headline="true"
                        :has-footer="true"
                ></x-shared.list-regions>

                </div>
        </div>

        <div class="row">

                <div class="col-md-6">
                    <x-shared.card-metric-simple
                        headline="Active Homes"
                        :metric="$homeCount"
                        button-url="#"
                        button-label="View All Homes"
                    />
                </div>

                <div class="col-md-6">
                    <x-shared.card-metric-simple
                        headline="Active Managers"
                        :metric="$managerCount"
                        button-url="#"
                        button-label="View All Managers"
                    />
                </div>

                <div class="col-md-6">
                    <x-shared.card-metric-simple
                        headline="Active Clients"
                        :metric="$clientCount"
                        button-url="#"
                        button-label="View All Clients"
                    />
                </div>

                <div class="col-md-6">
                    <x-shared.card-metric-simple
                        headline="Active Carers"
                        :metric="$carerCount"
                        button-url="#"
                        button-label="View All Carers"
                    />
                </div>



        </div>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection