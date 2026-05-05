@props([
    'clients',
    'home'
])
<div class="p-4 rounded border mb-2">
    <h2>Clients at {{ $home->home_name }}</h2>
    @if($clients !== null)
    <table>
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
                    <a href="#" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @else
    <p>Sorry, there aren't any clients at this home.</p>

    @endif
</div>