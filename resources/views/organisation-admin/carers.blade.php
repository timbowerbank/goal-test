        @extends('layouts.organisation')

        @section('title', 'Viewing Carers at ' . $organisation->organisation_name)

        @section('organisation-content')

            <x-shared.header
                :headline="'Viewing carers at ' . $organisation->organisation_name"
                :sub-headline="'You are viewing all active carers at ' . $organisation->organisation_name"
            ></x-shared.header>

            <div class="p-4 rounded border mb-2 bg-white">

                @if($carers->isNotEmpty())
                    <table class="w-100 table table-striped">
                        <thead>
                            <tr>
                                <th scope="row">Carer Name</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carers as $carer)
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

        @endsection