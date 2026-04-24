<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\CarerStatus;
use Illuminate\Support\Facades\Auth;
use App\Services\OrganisationAccessService;

class EnsureCarerBelongsToOrganisation
{

    // *** constructor() ***
    public function __construct(protected OrganisationAccessService $accessService){}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $openRoutes = ['carer.pending-verification', 'carer.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the carer
        $carer = Auth::user()->carer;

        // check if a carer profile exists
        if(!$carer) {
            abort(403, 'Access denied.');
        }

        // check if carer is not verified
        if(!$carer->is_verified) {
            return redirect()->route('carer.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if carer is active
        if($carer->carer_status !== CarerStatus::Active) {
            return redirect()->route('carer.inactive', ['org_id' => $request->route('org_id')]);
        }

        if(!$this->accessService->carerBelongsToOrganisation(Auth::user(), (int)$request->route('org_id'))) {
            abort(403, 'You do not belong to this organisation.');
        }


        return $next($request);
    }
}
