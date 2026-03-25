        @extends('layouts.manager')

        @section('title', 'Manager Dashboard')

        @section('manager-content')
        <h1>Manager Dashboard</h1>
        <p>This is for managers only</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection