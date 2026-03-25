        @extends('layouts.super-admin')

        @section('title', 'Super Admin Dashboard')

        @section('super-admin-content')
        <h1>Super Admin Dashboard</h1>
        <p>This is the super admin dashboard</p>
        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
            </form>
        @endsection