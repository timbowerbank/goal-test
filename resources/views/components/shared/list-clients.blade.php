@props([
    'clients',
    'home',
    'headline',
    'has-headline',
    'org-id',
    'region-id' => null,
    'is-card',
    'role'
])
<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    @if($hasHeadline)
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    @endif
    @if($clients !== null)
    <div @if($isCard) class="pd-table-scroll-outer" @endif>
        <table class="w-100 table table-striped">
            <colgroup>
                <col style="width: 75%">
                <col style="width: 25%">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">Client Name</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td scope="row">{{ $client->user->full_name }}</td>
                    <td>
                        @if($role === 'manager')
                        <a href="{{ route('manager.view-client', ['org_id' => $orgId, 'home_id' => $home->id, 'client_id' => $client->id]) }}" class="btn btn-secondary btn-sm">View</a>
                        @elseif($role === 'carer')
                        <a href="{{ route('carer.view-client', ['org_id' => $orgId, 'home_id' => $home->id, 'client_id' => $client->id ]) }}" class="btn btn-secondary btn-sm">View</a>
                        @elseif($role === 'regional-operator')
                        <a href="{{ route('regional-operator.view-client', ['org_id' => $orgId, 'region_id' => $regionId, 'client_id' => $client->id]) }}" class="btn btn-secondary btn-sm">View</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
    
        </table>
    </div>
        @if($isCard)
        <footer>
            @if($role === 'manager')
            <a href="{{ route('manager.view-clients', ['org_id' => $orgId, 'home_id' => $home->id])  }}" class="mt-2 btn btn-primary">View All Clients</a>
            @elseif($role === 'carer')
            <a href="{{ route('carer.view-clients', ['org_id' => $orgId, 'home_id' => $home->id])  }}" class="mt-2 btn btn-primary">View All Clients</a>
            @endif
        </footer>
        @endif
    @else
    <p>Sorry, there aren't any clients at this home.</p>

    @endif
</div>