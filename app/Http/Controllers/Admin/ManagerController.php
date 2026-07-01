<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Enums\ManagerStatus;

class ManagerController extends Controller
{
    // *** index() ***
    // show all managers for the organisation

    // middleware guarantees that
    // org admin is authenticated
    // and verified and active
    // is an org admin
    // and that they belong to the organisation
    // the organisation is active
    public function index($org_id) {

        $organisation = Organisation::with([
            'homes' => function($query){
                return $query->orderBy('home_name');
            },
            'homes.managers' => function($query){
                return $query->join('users', 'managers.user_id', '=', 'users.id')
                        ->where('manager_status', ManagerStatus::Active)
                        ->orderBy('users.surname')
                        ->select('managers.*');
            },
            'homes.managers.user'
        ])
            ->findOrFail($org_id);

        // flatten to a single deduplicated list, ordered by surname
        $managers = $organisation->homes
            ->flatMap(fn($home) => $home->managers)
            ->unique('id')
            ->sortBy(fn($manager) => $manager->user->surname);

        return view('organisation-admin.managers')
            ->with('organisation', $organisation)
            ->with('managers', $managers);
    }
}
