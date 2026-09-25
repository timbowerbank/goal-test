        @extends('layouts.regional-operator')
        
        @section('title', 'Viewing goal')

        @section('regional-operator-content')

            <x-shared.header
                :headline="'Viewing Goal: '. $goal->title"
                :sub-headline="'You are viewing the goal ' . $goal->title . ' for client ' . $goal->client->user->full_name . '.' "
            ></x-shared.header>

            <x-goal.summary
                :goal="$goal"
            ></x-goal.summary>

            <x-shared.list-tasks
                headline="Tasks"
                :tasks="$goal->tasks"
                :is-card="false"
                :org-id="$org_id"
                :home-id="$goal->home->id"
                role="regional-operator"
                :has-footer-button="true"
            ></x-shared.list-tasks>

            <x-shared.list-notes
                :notes="$goal->notes"
            ></x-shared.list-notes>

        @endsection
