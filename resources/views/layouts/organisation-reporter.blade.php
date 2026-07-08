         @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-md-2">
                @include('organisation-reporter.navigation')
            </div>

            <div class="col-md-10">
                @yield('organisation-reporter-content')
            </div>

        </div>

        @endsection