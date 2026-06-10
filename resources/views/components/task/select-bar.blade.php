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
                            @php
                                $filterLabels = ['all' => 'All tasks', 'due' => 'Due this week', 'overdue' => 'Overdue tasks'];
                            @endphp
                            @foreach($filterTypes as $filter)
                                <option value="{{ $filter }}" {{ $filterSelected === $filter ? 'selected' : ''}}>{{ $filterLabels[$filter] }}</option>
                            @endforeach
                        </select>

                        <span class="ms-2 me-2 mb-2 mb-md-0">+</span>

                        <select name="client" class="form-select mb-4 mb-md-0" aria-label="Default select example">
                            <option value="all" {{ $clientSelectedId === 'all' ? 'selected' : '' }}>All clients</option>
                            @foreach ($allHomeClients as $client)
                                <option value="{{ $client->id }}" {{ $clientSelectedId === $client->id ? 'selected' : '' }}>{{ $client->user->full_name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="ms-3 btn btn-primary">Go</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="row">
        @php
            $filterLabel = $filterLabels[$filterSelected];
            $clientLabel = $clientSelectedId === 'all' ? 'all clients' : $allHomeClients->firstWhere('id', $clientSelectedId)?->user->full_name;

        @endphp
        <div class="col"><p class="mb-0">Showing <strong>{{ strtolower($filterLabel) }}</strong> for <strong>{{ $clientLabel }}</strong> at <strong>{{ $homeName }}</strong></p></div>
    </div>
</div>