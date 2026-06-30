@props([
    'headline',
    'metric',
    'button-url',
    'button-label',
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    <hr>
    <div>
        <span class="fs-1 fw-bold">{{ $metric }}</span>
    </div>
    <footer>
        <a class="btn btn-primary mt-3" href="{{ $buttonUrl }}">{{ $buttonLabel }}</a>
    </footer>
</div>