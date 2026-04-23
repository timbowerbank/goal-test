<?php

namespace App\Http\Middleware;

use App\Services\OrganisationAccessService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureManagerBelongsToOrganisation {

    // *** constructor() ***
    public function __construct(protected OrganisationAccessService $accessService){}

    public function handle(Request $request, Closure $next) {

        // allow the following routes to bypass checks
        $openRoutes = ['manager.pending-verification', 'manager.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the manager
        $manager = Auth::user()->manager;

        // check if a manager
        if(!$manager) {
            abort(403, 'Access denied.');
        }

        // check if verified
        if(!$manager->is_verified) {
            return redirect()->route('manager.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if not active
        if($manager->manager_status !== 'active') {
            return redirect()->route('manager.inactive', ['org_id' => $request->route('org_id')]);
        }

        // doesn't belong to an organisation
        if(!$this->accessService->managerBelongsToOrganisation(Auth::user(), (int)$request->route('org_id'))) {
            abort(403, 'You do not belong to this organisation.');
        }

        return $next($request);


        

    }


}