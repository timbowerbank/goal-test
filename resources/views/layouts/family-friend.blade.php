        @extends('layouts.app')

        @section('content')

        <div class="row">
            <div class="col-2">
                @include('family-friend.navigation')
            </div>

            <div class="col-10">
                @yield('family-friend-content')
            </div>

        </div>

        @endsection