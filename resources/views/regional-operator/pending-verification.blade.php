        @extends('layouts.regional-operator')

        @section('title', 'Regional operator is Pending Verification')

        @section('regional-operator-content')

        <p>Regional operator is pending verification</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection