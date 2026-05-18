@props([
    'notes'
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>Goal Notes</h2>
    </header>
    <table class="w-100 table table-striped table-fixed">
        <thead>
            <tr>
                <th scope="col" class="col-2">Date</th>
                <th class="col-8">Note</th>
                <th class="col-2">Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr scope="row">
                    <td>
                        {{ $note->created_at->format('d M Y') }}
                    </td>
                    <td>
                        {{ $note->note }}
                    </td>
                    <td>
                        {{ $note->createdBy->full_name }}
                    </td>
                </tr>
                
            @endforeach

        </tbody>
    </table>

</div>