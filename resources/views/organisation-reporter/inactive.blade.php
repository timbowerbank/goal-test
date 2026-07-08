        @extends('layouts.organisation-reporter')

        @section('title', 'Organisation Reporter Inactive')

        @section(organisation-reporter-content)

            <p>Organisation reporter is inactive</p>

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>

        @endsection