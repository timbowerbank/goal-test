            @extends('layouts.organisation')

            @section('title', 'Organisation Dashboard')

            @section('organisation-content')
            <h1>Organisation Dashboard</h1>
            <p>This is for organisation admins only</p>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>
            @endsection