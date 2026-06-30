<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2 class="mb-3">{{ $headline }}</h2>
    </header>
    <div class="row">
        <div class="col-md-4 d-flex flex-column mb-4 mb-md-0">
            <h3>All Active Goals</h3>
            <hr>
            <div class="d-flex flex-row align-items-center">
                <span class="fs-1 fw-bold">{{ $totalActiveGoals }}</span>
                <span class="ms-2 fs-6">Active Goals</span>
            </div>
            
        </div>

        <div class="col-md-4 d-flex flex-column mb-4 mb-md-0">
            <h3>Overdue Goals</h3>
            <hr>
            <div class="d-flex flex-row align-items-center">
                <span class="fs-1 fw-bold">{{ $totalOverdueGoals }}</span>
                <span class="ms-2 fs-6">Overdue Goals</span>
            </div>
        </div>

        <div class="col-md-4 d-flex flex-column mb-4 mb-md-0">
            <h3>Goal Creation</h3>
            <hr>
            <div class="d-flex flex-row align-items-center">
                <span class="fs-1 fw-bold">{{ $totalNewGoalsThisMonth }}</span>
                <span class="ms-2 fs-6">Created and started in {{ $now->format('F') }}</span>
            </div>
        </div>

        
    </div>

    <footer>
        <a href="{{ $buttonUrl }}" class="btn btn-primary mt-3">View All Goals</a>
    </footer>
  
</div>