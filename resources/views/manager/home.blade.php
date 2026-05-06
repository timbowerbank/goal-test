        @extends('layouts.manager')

        @section('title', $home->home_name)

        @section('manager-content')
        <x-shared.header headline="{{ $home->home_name }}" sub-headline="Welcome to {{ $home->home_name }}"></x-shared.header>

        <div class="row">
            <div class="col-md-6">
                <x-shared.list-clients :clients="$home->clients" :home="$home"></x-shared.list-clients>
            </div>
            <div class="col-md-6">
                <x-shared.list-carers :carers="$home->carers" :home="$home"></x-shared.list-carers>
            </div>
        </div>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection