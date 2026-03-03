        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-2">
                @include('organisation.navigation')
            </div>

            <div class="col-10">
                @yield('organisation-content')
            </div>

        </div>

        @endsection