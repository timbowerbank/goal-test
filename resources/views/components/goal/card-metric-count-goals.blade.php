<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2 class="mb-3">{{ $headline }}</h2>
    </header>
    <div class="row">
        <div class="col-md-4 d-flex flex-column">
            <h3>All Active Goals</h3>
            <hr>
            <span class="fs-1 fw-bold">{{ $totalActiveGoals }}</span>
        </div>

        <div class="col-md-4 d-flex flex-column">
            <h3>Overdue Goals</h3>
            <hr>
            <span class="fs-1 fw-bold">{{ $totalOverdueGoals }}</span>
        </div>

        <div class="col-md-4 d-flex flex-column">
            <h3>Goal Creation</h3>
            <hr>
            <span class="fs-1 fw-bold">{{ $totalNewGoalsThisMonth }}</span>
            <span class="fs-6">Created and started in {{ $now->format('F') }}</span>
        </div>

        
    </div>

    <footer>
        <a href="#" class="btn btn-primary mt-3">View All Goals</a>
    </footer>
  
</div>