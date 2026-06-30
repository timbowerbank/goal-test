        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-md-2">
                @include('organisation-admin.navigation')
            </div>

            <div class="col-md-10">
                @yield('organisation-content')
            </div>

        </div>

        @endsection