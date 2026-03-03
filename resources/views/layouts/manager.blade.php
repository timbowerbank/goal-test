        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-2">
                @include('manager.navigation')
            </div>

            <div class="col-10">
                @yield('manager-content')
            </div>

        </div>

        @endsection