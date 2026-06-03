    @extends('layouts.manager')

    @section('title', $carer->user->full_name)

    @section('manager-content')
    <x-shared.header 
        :headline="'Viewing Carer: ' . $carer->user->full_name" 
        :sub-headline="'Welcome to ' . $carer->user->first_name . '\'s Dashboard.'"></x-shared.header>

    <x-task.list-kanban
        :headline="'Tasks for ' . $carer->user->first_name"
        :not-started-tasks="$notStarted"
        :in-progress-tasks="$inProgress"
        :complete-tasks="$completed"
        :view-task-url="'/organisations/' . $org_id . '/manager/homes/' . $home_id . '/carers/' . $carer->id . '/tasks/'"
    ></x-task.list-kanban>

    {{-- <x-shared.list-tasks
        :headline="'Tasks for ' . $carer->user->first_name"
        :tasks="$carer->tasks"
        :is-card="true"
    ></x-shared.list-tasks> --}}

    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary mt-3" type="submit">Logout</button>
    </form>
    @endsection