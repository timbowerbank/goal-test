        @extends('layouts.organisation')

        @section('title', 'Viewing all goals')

        @section('organisation-content')
            <x-shared.header
                :headline="'All goals at: ' . $organisation->organisation_name"
                :sub-headline="'You are viewing all active goals ' . $organisation->organisation_name"
            ></x-shared.header>

            <div class="p-4 rounded border mb-2 bg-white">
                @if($goals->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Goal Name</th>
                                <th>Home Name</th>
                                <th class="d-none d-md-table-cell">Client Name</th>
                                <th class="d-none d-md-table-cell">Activity Type</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organisation->homes as $home)
                                @foreach($home->clients as $client)
                                    @foreach($client->goals as $goal)
                                        <tr>
                                            <td scope="row">{{ $goal->title }}</td>
                                            <td>{{ $home->home_name }}</td>
                                            <td class="d-none d-md-table-cell">{{ $client->user->full_name }}</td>
                                            <td class="d-none d-md-table-cell">
                                                @foreach($goal->activityTypes as $activityType)
                                                    {{ $activityType->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm" href="#">View</a>
                                            </td>
                                        </tr>
                                  @endforeach
                                
                                @endforeach
                            @endforeach
                        </tbody>

                    </table>

                @else
                <p>No active goals</p>
                @endif
            </div>

        @endsection