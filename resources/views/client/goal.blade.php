        @extends('layouts.client')

        @section('title', 'Goal view for client')


        @section('client-content')
            <x-shared.header
                :headline="'Viewing Goal: ' . $goal->title"
                :sub-headline="'Viewing goal ' . $goal->title . ' for ' . $goal->client->user->full_name ">
            </x-shared.header>

            <x-goal.summary
               :goal="$goal" 
            ></x-goal.summary>

            <x-shared.list-tasks
                :headline="'Tasks for ' . $goal->title"
                :tasks="$tasks"
                :is-card="false"
                :org-id="$org_id"
                home-id=""
                role="client"
                :has-footer-button="false"
            ></x-shared.list-tasks>

            <x-shared.list-notes
                :notes="$goal->notes"
            ></x-shared.list-notes>

        @endsection