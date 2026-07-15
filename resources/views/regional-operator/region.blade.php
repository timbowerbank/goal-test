        @extends('layouts.regional-operator')

        @section('title', 'Viewing Region')

        @section('regional-operator-content')
            <x-shared.header
                headline="Viewing region"
                sub-headline="You are viewing a region"
            ></x-shared.header>

            <div class="row">
                <div class="col-12">
                    <x-goal.card-metric-count-goals
                        :headline="'Goal Stats for: ' . $region->name"
                        :goals="$regionGoals"
                        button-url="#"
                    />
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <x-shared.card-metric-simple
                        headline="Active Homes"
                        :metric="$homeCount"
                        button-url="{{ route('regional-operator.view-homes', ['org_id' => $org_id, 'region_id' => $region->id]) }}"
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