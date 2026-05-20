@props([
    'comments',
])

<div class="p-4 bg-white border rounded">
    <div class="row">
        <div class="col-8">
            <header>
                <h2>Comments</h2>
            </header>

        </div>
        <div class="col-4 d-flex justify-content-end align-items-start">
            <a href="#" class="btn btn-primary btn-sm">Comment</a>
        </div>
    </div>
    

    @forelse ($comments as $comment)
        <x-task.comment
            :comment="$comment">
        </x-task.comment>
    @empty
        <p>No comments for this task</p>
    @endforelse

</div>