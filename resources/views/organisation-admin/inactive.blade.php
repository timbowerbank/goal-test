    @extends('layouts.organisation')

    @section('title', 'Administrator Inactive')

    @section('organisation-content')
    <p>Administrator is inactive</p>
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection