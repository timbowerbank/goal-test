@props([
    'clients',
    'home',
    'org-id',
    'is-card',
    'role'
])
<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    @if($isCard)
    <header>
        <h2>Clients at {{ $home->home_name }}</h2>
    </header>
    @endif
    @if($clients !== null)
    <div @if($isCard) class="pd-table-scroll-outer" @endif>
        <table class="w-100 table table-striped">

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
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
    
        </table>
    </div>
        @if($isCard)
        <footer>
            <a href="{{ route('manager.view-clients', ['org_id' => $orgId, 'home_id' => $home->id])  }}" class="mt-2 btn btn-primary">View All Clients</a>
        </footer>
        @endif
    @else
    <p>Sorry, there aren't any clients at this home.</p>

    @endif
</div>