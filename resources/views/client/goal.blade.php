        @extends('layouts.client')

        @section('title', 'Goal view for client')


        @section('client-content')
            <x-shared.header
                headline="Viewing Goal"
                sub-headline="This is a sub headline for viewing a goal">
            </x-shared.header>


            {{-- Add the following components --}}
            {{-- <x-goal.summary></x-goal.summary>

            <x-shared.list-tasks></x-shared.list-tasks>

            <x-shared.list-notes></x-shared.list-notes> --}}

        @endsection