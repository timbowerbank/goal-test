        @extends('layouts.carer')

        @section('title', $goal->title)

        @section('carer-content')
            <x-shared.header
                :headline="'Viewing Goal: ' . $goal->title"
                :sub-headline="'You are viewing: ' . $goal->title . ' for ' . $goal->client->user->full_name"
            ></x-shared.header>

            <x-goal.summary
                :goal="$goal"
            ></x-goal.summery>

            <x-shared.list-tasks
                headline="Goal Tasks"
                :tasks="$goal->tasks"
                :is-card="false"
                :org-id="$org_id"
                :home-id="$home_id"
                role="carer"
            ></x-shared.list-tasks>

        @endsection