        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-2">
                @include('super-admin.navigation')
            </div>

            <div class="col-10">
                @yield('super-admin-content')
            </div>

        </div>

        @endsection