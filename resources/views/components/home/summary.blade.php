@props([
    'home'
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>Summary</h2>
    </header>
    <div class="row">
        <div class="col-md-6">
            <div>
                <p><strong>Home Name: </strong>{{ $home->home_name }}</p>
                <p><strong>Address Line 1: </strong>{{ $home->address_1 }}</p>
                <p><strong>Address Line 2: </strong>{{ $home->address_2 }}</p>
                <p><strong>City: </strong>{{ $home->city }}</p>
                <p><strong>Post Code: </strong>{{ $home->postcode }}</p>
                <p><strong>Created By: </strong>{{ $home->createdBy->full_name }}</p>
                <p><strong>Created On: </strong>{{ $home->createdBy->created_at->format('j M Y') }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <p><strong>Active Managers: </strong>{{ $home->managers->count() }}</p>
                <p><strong>Active Carers: </strong>{{ $home->carers->count() }}</p>
                <p><strong>Active Clients: </strong>{{ $home->clients->count() }}</p>
            </div>

            
        </div>

    </div>
    
    <footer>
        <a class="btn btn-primary mt-3" href="">Edit Home</a>
    </footer>

</div>