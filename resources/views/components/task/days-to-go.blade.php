@if($isLate)
    <span class="text-capitalize">{{ $daysToGo }} days overdue</span>
@else
    <span class="text-capitalize">{{ $daysToGo }} days to go</span>
@endif