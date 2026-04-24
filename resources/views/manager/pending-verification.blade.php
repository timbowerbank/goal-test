@extends('layouts.manager')

@section('title', 'Manager is Pending Verification')

@section('manager-content')

<p>Manager is pending verification</p>

<form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
</form>

@endsection