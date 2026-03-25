        @extends('layouts.client')
        
        @section('title', 'Client Dashboard')

        @section('client-content')
            <h1>This is the Client Dashboard</h1>
            <p>It will mostly use components that are pulled in from sub folders</p>

            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>
        @endsection

