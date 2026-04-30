@extends('layouts.family-friend')

@section('title', 'Family Friend is Pending Varification')

@section('family-friend-content')

<p>Family Friend is pending verification</p>

<form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
</form>

@endsection