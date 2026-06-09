        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-md-2">
                @include('carer.navigation')
            </div>

            <div class="col-md-10">
                @yield('carer-content')
            </div>

        </div>

        @endsection