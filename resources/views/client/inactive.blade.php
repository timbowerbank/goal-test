    @extends('layouts.client')
        
    @section('title', 'Client Inactive')

    @section('client-content')
        <p>Client is inactive</p>

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
    @endsection
