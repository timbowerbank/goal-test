@props([
    'carers',
    'home',
    'org-id',
    'is-card'
])

<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    @if($isCard)
    <header>
        <h2>Carers at {{ $home->home_name }}</h2>
    </header>
    @endif
    @if($carers !== null)
    <div @if($isCard) class="pd-table-scroll-outer" @endif>
        <table class="w-100 table table-striped">
            <thead>
                <tr>
                    <th scope="col">Carer Name</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carers as $carer)
                <tr>
                    <td scope="row">{{ $carer->user->full_name }}</td>
                    <td>
                        <a href="{{ route('manager.view-carer', ['org_id' => $orgId, 'home_id' => $home->id, 'carer_id' => $carer->id]) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    
        </table>
    </div>
        @if($isCard)
        <footer>
            <a href="{{ route('manager.view-carers', ['org_id' => $orgId, 'home_id' => $home->id]) }}" class="mt-2 btn btn-primary">View All Carers</a>
        </footer>
        @endif

    @else
    <p>Sorry, there aren't any carers assigned to this home.</p>

    @endif
</div>