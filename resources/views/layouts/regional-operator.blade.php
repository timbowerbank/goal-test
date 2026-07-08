        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-md-2">
                @include('regional-operator.navigation')
            </div>

            <div class="col-md-10">
                @yield('regional-operator-content')
            </div>

        </div>

        @endsection