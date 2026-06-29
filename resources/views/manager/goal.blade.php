        @extends('layouts.manager')

        @section('title', $goal->title)

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
                :org-id="$org_id"
                :home-id="$home_id"
                role="manager"
                :has-footer-button="false"
        ></x-shared.list-tasks>

        <x-shared.list-notes :notes="$goal->notes"></x-shared.notes>

        <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary mt-3" type="submit">Logout</button>
        </form>
        @endsection