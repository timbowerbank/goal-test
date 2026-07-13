        @extends('layouts.regional-operator')

        @section('title', 'Regional Operator Dashboard')

        @section('regional-operator-content')
        <x-shared.header 
                :headline="'Dashboard for ' . $regionalOperator->user->full_name" 
                :sub-headline="'You are logged in as a Regional Operator at ' . $organisation->organisation_name . '.'"></x-shared.header>

        <x-shared.list-regions
                :regions="$regionalOperator->regions"
                :org-id="$organisation->id"
                :headline="'Regions Allocated to ' . $regionalOperator->user->first_name"
                :has-headline="true"
                :has-footer="true"
        ></x-shared.list-regions>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection