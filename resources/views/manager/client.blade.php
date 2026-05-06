        @extends('layouts.manager')

        @section('title', '$client->user->full_name')

        @section('manager-content')
     
        <p>Viewing Client {{ $client->user->full_name }}</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection