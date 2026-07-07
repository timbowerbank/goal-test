@props([
    'headline',
    'goal-count',
    'task-count'

])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    <div class="row">
        <div class="col-md-6 d-flex flex-column mb-4 mb-md-0">
            <header>
                <h3>Goals Completed</h3>
                <p>Goals completed with clients</p>
                <hr>
            </header>
            <div class="d-flex flex-row align-items-center">
                <span class="fs-1 fw-bold">{{ $goalCount }}</span>
                <span class="fs-6 ms-2">Goals Completed</span>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column mb-4 mb-md-0">
            <header>
                <h3>Tasks Completed</h3>
                <p>Tasks completed with clients</p>
                <hr>
            </header>
            <div class="d-flex flex-row align-items-center">
                <span class="fs-1 fw-bold">{{ $taskCount }}</span>
                <span class="fs-6 ms-2">Tasks Completed</span>
            </div>
        </div>
    </div>
</div>