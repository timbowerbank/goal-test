        @extends('layouts.carer')

        @section('title', 'Viewing Tasks for Carer - add name')

        @section('carer-content')

            <x-shared.header
                headline="Viewing Tasks for a Home"
                sub-headline="Look at these tasks"
            >
            </x-shared.header>

            <x-task.select-bar></x-task.select-bar>


        @endsection