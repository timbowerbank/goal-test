@props([
    'staff-member'
])

<div class="p-4 rounded border mb-2 bg-white">
    <header>
        <h2>Summary</h2>
    </header>
    <div>
        <p><strong>First Name: </strong> {{ $staffMember->user->first_name }}</p>
        <p><strong>Surname: </strong> {{ $staffMember->user->surname }}</p>
        <p><strong>Verified By: </strong> {{ $staffMember->verifiedBy->full_name }}</p>
        <p><strong>Verified On: </strong> {{ $staffMember->verified_at->format('j M Y') }}</p>
    </div>
    <footer>
        <a class="btn btn-primary" href="#">Edit</a>
    </footer>



</div>