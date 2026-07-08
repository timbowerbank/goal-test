<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\OrganisationAccessService;
use App\Enums\RegionalOperatorStatus;
use Illuminate\Support\Facades\Auth;


class EnsureRegionalOperatorBelongsToOrganisation
{

    // *** CONSTRUCTOR() ***
    public function __construct(protected OrganisationAccessService $accessService){}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get the user
        $user = Auth::user();

        $openRoutes = ['regional-operator.pending-verification', 'regional-operator.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the regional operator
        $regionalOperator = $user->regionalOperator;

        // check if a regional operator profile exists
        if(!$regionalOperator) {
            abort(403, 'Access denied.');
        }

        if(!$this->accessService->regionalOperatorBelongsToOrganisation($user, $request->route('org_id'))) {
            abort(403, 'You do not belong to this organisation.');
        }

        // check if regional operator is not verified
        if(!$regionalOperator->is_verified) {
            return redirect()->route('regional-operator.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if regional operator is active
        if($regionalOperator->ro_status !== RegionalOperatorStatus::Active) {
            return redirect()->route('regional-operator.inactive', ['org_id' => $request->route('org_id')]);
        }

        return $next($request);
    }
}
