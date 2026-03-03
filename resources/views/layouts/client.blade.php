        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-2">
                @include('client.navigation')
            </div>

            <div class="col-10">
                @yield('client-content')
            </div>

        </div>

        @endsection