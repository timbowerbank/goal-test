@props([
    'clients',
    'home',
    'org-id',
])
<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    <header>
        <h2>Clients at {{ $home->home_name }}</h2>
    </header>
    @if($clients !== null)
    <div class="pd-table-scroll-outer">
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
                        <a href="{{ route('manager.view-client', ['org_id' => $orgId, 'home_id' => $home->id, 'client_id' => $client->id]) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    
        </table>
    </div>
    <footer>
        <a href="#" class="mt-2 btn btn-primary">View All Clients</a>
    </footer>

    @else
    <p>Sorry, there aren't any clients at this home.</p>

    @endif
</div>