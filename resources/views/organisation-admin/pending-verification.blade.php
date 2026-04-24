    @extends('layouts.organisation')

    @section('title', 'Administrator Pending Verification')

    @section('organisation-content')
    <p>Administrator is pending verification</p>
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection