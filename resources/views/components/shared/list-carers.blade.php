@props([
    'carers',
    'home'
])

<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    <header>
        <h2>Carers at {{ $home->home_name }}</h2>
    </header>
    @if($carers !== null)
    <div class="pd-table-scroll-outer">
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
                        <a href="#" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    
        </table>
        <footer>
            <a href="#" class="mt-2 btn btn-primary">View All Carers</a>
        </footer>
    </div>

    @else
    <p>Sorry, there aren't any carers assigned to this home.</p>

    @endif
</div>