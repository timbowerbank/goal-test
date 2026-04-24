        @extends('layouts.carer')       
        
        @section('title', 'Carer Inactive')

        @section('carer-content')
        <p>Carer Inactive</p>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>

        @endsection