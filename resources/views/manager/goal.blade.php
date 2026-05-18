        @extends('layouts.manager')

        @section('title', 'Goal Title holder')

        @section('manager-content')
        <x-shared.header
            :headline="'View Goal: ' . $goal->title"
            :sub-headline="'Viewing Goal for ' . $goal->client->user->full_name">
        </x-shared.header>

        <x-goal.summary
                :goal="$goal"
        ></x-goal.summary>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection