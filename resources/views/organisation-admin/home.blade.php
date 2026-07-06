        @extends('layouts.organisation')

        @section('title', 'Viewing Home')

        @section('organisation-content')

            <x-shared.header
                :headline="'Viewing Home: ' . $home->home_name"
                :sub-headline="'You are viewing ' . $home->home_name"
            ></x-shared.header>

            <x-home.summary
                :home="$home"
            ></x-home.summary>

            <x-goal.card-metric-count-goals
                :headline="'Goal metrics for ' . $home->home_name"
                :goals="$goals"
                button-url="#"
            ></x-goal.card-metric-count-goals>    
            {{-- add in card of goals, overdue goals and goal creation in month --}}

            {{-- managers --}}
            <div class="p-4 rounded border mb-2 bg-white">
                <header>
                    <h2>Managers at {{ $home->home_name }}</h2>
                </header>
                @if($home->managers->isNotEmpty())
                        <table class="w-100 table table-striped">
                            <colgroup>
                                <col style="width: 75%">
                                <col style="width: 25%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="row">Manager Name</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($home->managers as $manager)
                                    <tr>
                                        <td scope="row">{{ $manager->user->full_name }}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm" href="#">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <p>There are no managers to show.</p>
    
                    @endif
            </div>

            {{-- carers --}}
            <div class="p-4 rounded border mb-2 bg-white">
                <header>
                    <h2>Carers at {{ $home->home_name }}</h2>
                </header>

                @if($home->carers->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <colgroup>
                            <col style="width: 75%">
                            <col style="width: 25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="row">Carer Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($home->carers as $carer)
                                <tr>
                                    <td scope="row">{{ $carer->user->full_name }}</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm" href="#">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else

                    <p>There are no active carers to show.</p>

                @endif
            </div>

            {{-- add in table of clients --}}
            <div class="p-4 rounded border mb-2 bg-white">
                <header>
                    <h2>Clients at {{ $home->home_name }}</h2>
                </header>
                @if($home->clients->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <colgroup>
                            <col style="width: 50%">
                            <col style="width: 25%">
                            <col style="width: 25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="row">Client Name</th>
                                <th># Active Goals</th>
                                <th>View</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($home->clients as $client)
                                <tr>
                                    <td scope="row">{{ $client->user->full_name }}</td>
                                    <td>{{ $client->goals->count() }}</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm" href="#">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <p>There are no clietns to show</p>
                @endif

            </div>


        @endsection