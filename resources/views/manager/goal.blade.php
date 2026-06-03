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

        <x-shared.list-tasks 
                headline="Goal Tasks"
                :tasks="$goal->tasks"
                :org-id="$orgId"
                :home-id="$homeId"
        ></x-shared.list-tasks>

        <x-shared.list-notes :notes="$goal->notes"></x-shared.notes>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection