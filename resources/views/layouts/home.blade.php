        @extends('layouts.app')

        @section('title', 'J-Goal Home')

        @section('content')
        <div class="row">
            <div class="col">
                <a class="btn btn-primary mt-3" href="/login">Login</a>

                <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
            </div>
        </div>
        @endsection