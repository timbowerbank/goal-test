@extends('layouts.family-friend')

@section('title', 'Family Friend is Inactive')

@section('family-friend-content')

<p>Family Friend is inactive</p>

<form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
</form>

@endsection