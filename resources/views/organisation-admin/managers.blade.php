        @extends('layouts.organisation')

        @section('title', 'Viewing Managers')

        @section('organisation-content')
            <x-shared.header
                :headline="'All managers at: ' . $organisation->organisation_name"
                :sub-headline="'Viewing all active managers at ' . $organisation->organisation_name"
            ></x-shared.header>

            <div class="p-4 rounded border mb-2 bg-white">
                @if($managers->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <thead>
                            <tr>
                                <th scope="row">Manager Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($managers as $manager)
                                <tr>
                                    <td scope="row">{{ $manager->user->full_name }}</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm" href="{{ route('organisation-admin.view-manager', 
                                            [
                                                'org_id' => $organisation->id, 
                                                'manager_id' => $manager->id]) }}"
                                        >View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <p>There are no managers to show.</p>

                @endif

            </div>

        @endsection
