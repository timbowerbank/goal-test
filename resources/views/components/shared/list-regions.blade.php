@props([
    'regions',
    'org-id',
    'headline',
    'has-headline',
    'has-footer',
])

<div class="p-4 rounded border mb-2 bg-white">
    @if($hasHeadline)
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    @endif

    @if($regions->isNotEmpty())
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Region Name</th>
                <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $region)
                <tr>
                    <th scope="row">{{ $region->name }}</th>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="{{ route('regional-operator.view-region', ['org_id' => $orgId, 'region_id' => $region->id]) }}">View Region</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You do not have any regions assigned.</p>
    @endif

    @if($hasFooter)
    <footer>
        <a href="#" class="btn btn-primary">View All Regions</a>
    </footer>
    @endif

</div>

