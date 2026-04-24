    @extends('layouts.client')
        
    @section('title', 'Client Pending Verification')

    @section('client-content')
        <p>Client is pending verification</p>

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
    @endsection

