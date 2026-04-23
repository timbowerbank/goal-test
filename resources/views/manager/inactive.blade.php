@extends('layouts.manager')

@section('title', 'Manager is Inactive')

@section('manager-content')

<p>Manager is inactive</p>

<form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
</form>

@endsection