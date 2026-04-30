        @extends('layouts.family-friend')

        @section('title', 'Family Friend Dashboard')

        @section('family-friend-content')
        <h1>Family Friend Dashboard</h1>
        <p>This is for family friends only</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection