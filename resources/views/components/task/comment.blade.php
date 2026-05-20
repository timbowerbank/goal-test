<div class="p-4 border rounded mb-2">
    <div class="row">
        <div class="col-8">
            {{ $comment->comment }}
        </div>
        <div class="col-4 d-flex flex-column fs-6">
            <p>{{ $comment->createdBy->full_name }}</p>
            @if($daysSince === 0)
                <p>Today</p>
            @elseif($daysSince === 1)
                <p>Yesterday</p>
            @else
                <p>{{ $comment->created_at->format('j M Y') }}</p>
            @endif

        </div>
    </div>
</div>