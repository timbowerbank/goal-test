        @extends('layouts.organisation-reporter')

        @section('title', 'Viewing region')

        @section('organisation-reporter-content')
            
            <x-shared.header
                :headline="'Viewing region: ' . $region->name"
                :sub-headline="'You are viewing the region ' . $region->name . '.'"
            ></x-shared.header>
            
            <div class="row">
                <div class="col-12">

                    <x-goal.card-metric-count-goals
                        :headline="'Goal Stats for region: ' . $region->name"
                        :goals="$goals"
                        button-url="#"
                    ></x-goal.card-metric-count-goals>
                
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
            
            

        @endsection