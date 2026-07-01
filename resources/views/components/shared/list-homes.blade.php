@props([
    'homes',
    'org-id',
    'role',
    'has-footer-button'

])
<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>My Homes</h2>
    </header>
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
                    <td class="d-none d-md-table-cell"><a class="link" href="tel:{{ $home->telephone }}">{{ $home->telephone }}</a></td>
                    <td>
                        @if($role === 'manager')
                        <a href="{{ route('manager.home', ['org_id' => $orgId, 'home_id' => $home->id]) }}" class="btn btn-secondary btn-sm">View</a>
                        @elseif($role === 'carer')
                        <a href="{{ route('carer.home', ['org_id' => $orgId, 'home_id' => $home->id]) }}" class="btn btn-secondary btn-sm">View</a>
                        @elseif($role === 'organisation-administrator')
                        <a class="btn btn-secondary btn-sm" href="#">View</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($hasFooterButton)
        <footer>
            <a href="#" class="mt-2 btn btn-primary">View All Homes</a>
        </footer>
        @endif
    @else

    <p>You currently don't have any homes assigned.</p>

    @endif
</div>