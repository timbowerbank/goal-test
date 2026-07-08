        @extends('layouts.regional-operator')

        @section('title', 'Regional Operator is Inactive')

        @section('regional-operator-content')

        <p>Regional operator is inactive</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection