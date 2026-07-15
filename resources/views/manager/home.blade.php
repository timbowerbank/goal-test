        @extends('layouts.manager')

        @section('title', $home->home_name)

        @section('manager-content')
        <x-shared.header headline="{{ $home->home_name }}" sub-headline="Welcome to {{ $home->home_name }}"></x-shared.header>

        <div class="row">
            <div class="col-md-6">
                <x-shared.list-clients 
                    :clients="$home->clients" 
                    :home="$home"
                    :headline="'Clients at ' . $home->home_name"
                    :has-headline="true" 
                    :org-id="$org_id" 
                    :is-card="true" 
                    role="manager">
                </x-shared.list-clients>
            </div>
            <div class="col-md-6">
                <x-shared.list-carers 
                    :carers="$home->carers" 
                    :home="$home"
                    headline=""
                    :has-headline="false" 
                    :org-id="$org_id" 
                    :is-card="true"
                ></x-shared.list-carers>
            </div>
        </div>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection