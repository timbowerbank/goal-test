<div class="border p-4 mb-2 rounded bg-white">
    <header>
        <h2>My Task Summary</h2>
    </header>
    <table class="table table-striped w-100">
        <thead>
            <tr>
                <th>Tasks</th>
                <th>Count</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <tr scope="row">
                <th>Overdue Tasks</th>
                <td>{{ $overdueTasks }}</td>
                <td>
                    <a href="#" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
            <tr>
                <th>Due This Week</th>
                <td>{{ $dueThisWeek }}</td>
                <td>
                    <a href="#" class="btn btn-secondary btn-sm">View</a>
                </td>
            </tr>
        </tbody>

    </table>

    <footer>
        <a href="#" class="btn btn-primary mt-2">View All Tasks</a>
    </footer>



</div>