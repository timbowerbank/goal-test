        @extends('layouts.organisation-reporter')

        @section('title', 'Organisation Reporter is not verified')

        @section('organisation-reporter-content')

            <p>Organisation reporter is not verified</p>

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>

        @endsection