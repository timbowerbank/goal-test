@props([
    'goal',
])


<div class="p-4 rounded border mb-2 bg-white">
    <h2 class="mb-2">Overview</h2>
    <p><strong>Created:</strong> 
        {{ $goal->created_at->format('j F Y') }}
    </p>
    <p><strong>Created By: </strong>
        {{ $goal->createdBy->full_name }}
    </p>
    <p><strong>Description:</strong>
        {{ $goal->description }} 
    </p>
</div>