@props([
    'tasks',
    'home',
])

<div class="bg-white rounded border w-100 p-4">
    <div class="row mb-4">
        <!-- lefthand col -->
        <div class="col-md-1 d-flex flex-md-row align-items-center">
            <p class="mb-md-0"><strong>Filter</strong></p>
        </div>

        <!-- righthand col -->
        <div class="col-md-11">
            <div>
                <form method="post" action="">
                    @csrf
                    <div class="d-flex flex-column flex-md-row align-items-center ">
                        <select class="form-select mb-2 mb-md-0" aria-label="Default select example">
                            <option selected>Overdue Tasks</option>
                            <option value="1">Due This Week</option>
                            <option value="2">All</option>
                        </select>

                        <span class="ms-2 me-2 mb-2 mb-md-0">+</span>

                        <select class="form-select mb-4 mb-md-0" aria-label="Default select example">
                            <option selected>All Clients</option>
                            <option value="1">Client 1</option>
                            <option value="2">Client 2</option>
                            <option value="3">Client 3</option>
                        </select>
                        <button type="submit" class="ms-3 btn btn-primary">Go</button>

                    </div>
                </form>

            </div>




        </div>

    </div>
    <div class="row">
        <div class="col"><p class="mb-0">Showing <strong>Overdue Tasks</strong> for <strong>All Clients</strong> at <strong>House Name</strong></p></div>
    </div>
</div>