        @extends('layouts.organisation')

        @section('title', 'Viewing all clients')

        @section('organisation-content')
            <x-shared.header
                headline="Viewing all clients"
                sub-headline="You are viewing all active clients at"
            ></x-shared.header>


            <div class="p-4 rounded border mb-2 bg-white">
                @if($clients->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <thead>
                            <tr>
                                <th scope="row">Client Name</th>
                                <th>Home Name</th>
                                <th>View</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($organisation->homes as $home)
                                @foreach($home->clients as $client)
                                    <tr>
                                        <td scope="row">{{ $client->user->full_name }}</td>
                                        <td>{{ $home->home_name }}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm" href="#">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach



                        </tbody>




                    </table>
                @endif

            </div>



        @endsection