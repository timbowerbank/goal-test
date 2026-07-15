@props([
    'carers',
    'home',
    'headline',
    'has-headline',
    'org-id',
    'is-card',
    'role'

])

<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    @if($hasHeadline)
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    @endif
    @if($carers !== null)
    <div @if($isCard) class="pd-table-scroll-outer" @endif>
        <table class="w-100 table table-striped">
            <colgroup>
                <col style="width: 75%">
                <col style="width: 25%">
            </colgroup>
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
                        @if($role === 'manager')
                        <a href="{{ route('manager.view-carer', ['org_id' => $orgId, 'home_id' => $home->id, 'carer_id' => $carer->id]) }}" class="btn btn-secondary btn-sm">View</a>
                        @elseif($role === 'regional-operator')
                        <a href="#" class="btn btn-secondary btn-sm">View</a>

                        @endif
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