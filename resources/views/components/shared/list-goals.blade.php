@props([
    'headline',
    'goals',
    'has-headline',
    'org-id',
    'home-id',
    'client-id',
    'role'
])


<div class="p-4 rounded border mb-2 pd-list-card-with-scroll bg-white">
    @if($hasHeadline)
    <header>
        <h2>{{ $headline }}</h2>
    </header>
    @endif
    @if($goals)
        <table class="w-100 table table-striped">
            <thead>
                <tr>
                    <th scope="col">Goal Name</th>
                    {{-- <th class="d-none d-md-table-cell">Goal Description</th> --}}
                    <th class="d-none d-md-table-cell">Goal Type</th>
                    <th class="d-none d-md-table-cell">Activity Type</th>
                    <th class="d-none d-md-table-cell">Goal Status</th>
                    <th class="d-none d-md-table-cell">Goal Lead</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>
                @foreach($goals as $goal)
                    <tr>
                        <td scope="row">{{ $goal->title }}</td>
                        {{-- <td class="d-none d-md-table-cell">{{ $goal->description }}</td> --}}
                        <td class="d-none d-md-table-cell">{{ $goal->goal_type }}</td>
                        <td class="d-none d-md-table-cell">
                            @foreach($goal->activityTypes as $activityType)
                            {{ $activityType->name }}

                            @endforeach
                        </td>
                        <td class="d-none d-md-table-cell">{{ $goal->goal_status }}</td>
                        <td class="d-none d-md-table-cell">{{ $goal->leadBy->full_name }}</td>
                        <td>
                            @if($role === 'manager')
                            <a href="
                                {{ route('manager.view-goal', 
                                [
                                    'org_id' => $orgId, 
                                    'home_id' => $homeId, 
                                    'client_id' => $clientId,
                                    'goal_id' => $goal->id,
                                ]) }}" class="btn btn-secondary btn-sm">View Goal</a>
                            @elseif($role === 'carer')
                                <a href="
                                {{ route('carer.view-goal', 
                                [
                                    'org_id' => $orgId, 
                                    'home_id' => $homeId, 
                                    'client_id' => $clientId,
                                    'goal_id' => $goal->id,
                                ]) }}" class="btn btn-secondary btn-sm">View Goal</a>
                            @elseif($role === 'client')
                                <a href="#" class="btn btn-secondary btn-sm">View Goal</a>

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <footer>
        <a href="" class="btn btn-primary mt-3">View All Goals</a>
    </footer>

    @else 
    <p>Sorry, there are no goals to show.</p>
    @endif

</div>
