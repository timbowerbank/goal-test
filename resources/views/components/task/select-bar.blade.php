@props([
    'filter-types',
    'filter-selected',
    'client-selected-id',
    'all-home-clients',
    'home-name',
    'route'
])

<div class="bg-white rounded border w-100 p-4 mb-4">
    <div class="row mb-4">
        <!-- lefthand col -->
        <div class="col-md-1 d-flex flex-md-row align-items-center">
            <p class="mb-md-0"><strong>Filter</strong></p>
        </div>

        <!-- righthand col -->
        <div class="col-md-11">
            <div>
                <form method="get" action="{{ $route }}">
                    @csrf
                    <div class="d-flex flex-column flex-md-row align-items-center ">
                        <select name="filterType" class="form-select mb-2 mb-md-0" aria-label="Default select example">
                            @foreach($filterTypes as $filter)
                                @if($filterSelected === $filter)
                                    @if($filter === 'due')
                                    <option selected value="{{ $filter }}">Due this week</option>
                                    @elseif($filter === 'overdue')
                                    <option selected value="{{ $filter }}">Overdue tasks</option>
                                    @else
                                    <option selected value="{{ $filter }}">All tasks</option>
                                    @endif
                                @else
                                    @if($filter === 'due')
                                    <option value="{{ $filter }}">Due this week</option>
                                    @elseif($filter === 'overdue')
                                    <option value="{{ $filter }}">Overdue tasks</option>
                                    @else
                                    <option value="{{ $filter }}">All tasks</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>

                        <span class="ms-2 me-2 mb-2 mb-md-0">+</span>

                        <select name="client" class="form-select mb-4 mb-md-0" aria-label="Default select example">
                            @if($clientSelectedId === 'all')
                                <option selected value="all">All Clients</option>
                                @foreach($allHomeClients as $client)
                                    <option value="{{ $client->id }}">{{ $client->user->full_name }}</option>
                                @endforeach
                            @else 
                                @foreach($allHomeClients as $client)
                                    @if($client->id === $clientSelectedId)
                                        <option selected value="{{ $client->id }}">{{ $client->user->full_name }}</option>
                                        @continue
                                    @else
                                        <option value="{{ $client->id }}">{{ $client->user->full_name }}</option>
                                    @endif
                                        
                                @endforeach
                                <option value="all">All Clients</option>
                            @endif

                        </select>
                        <button type="submit" class="ms-3 btn btn-primary">Go</button>

                    </div>
                </form>

            </div>




        </div>

    </div>
    <div class="row">
        <div class="col"><p class="mb-0">Showing 

            @if($filterSelected === 'all')
            <strong>all tasks</strong>
            @elseif($filterSelected === 'due')
            <strong>tasks due this week </strong>
            @else
            <strong>overdue tasks</strong>
            @endif
            

            for 
            @if($clientSelectedId === 'all')
            <strong>all clients</strong> 
            @else
            <strong>
                @foreach($allHomeClients as $client)
                    @if($client->id === $clientSelectedId)
                        {{ $client->user->full_name }}
                        @break
                    @endif
                @endforeach
            </strong>
            @endif
            at <strong>{{ $homeName }}</strong></p></div>
    </div>
</div>