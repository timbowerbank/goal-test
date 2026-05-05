@props([
    'homes',
    'is-manager',
])
<div class="p-2 rounded border mb-2">
    <h2>My Homes</h2>
    @if($homes !== null)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Home Name</th>
                <th class="d-none d-md-table-cell" scope="col">Address</th>
                <th class="d-none d-md-table-cell" scope="col">City</th>
                <th class="d-none d-md-table-cell" scope="col">Telephone</th>
                <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($homes as $home)
            <tr>
                <th scope="row">{{ $home->home_name }}</th>
                <td class="d-none d-md-table-cell">{{ $home->address_1 }}</td>
                <td class="d-none d-md-table-cell">{{ $home->city }}</td>
                <td class="d-none d-md-table-cell">{{ $home->telephone }}</td>
                <td>
                    <a href="#" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else

    <p>You currently don't have any homes assigned.</p>

    @endif
    



</div>