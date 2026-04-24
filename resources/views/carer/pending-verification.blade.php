        @extends('layouts.carer')       
        
        @section('title', 'Carer Waiting for Verification')

        @section('carer-content')
        <p>Carer waiting for verification</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection