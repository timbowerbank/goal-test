<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\OrganisationAccessService;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrganisationAdministratorStatus;
use App\Enums\OrganisationStatus;
use App\Models\Organisation;

class EnsureAdministratorBelongsToOrganisation
{

    public function __construct(protected OrganisationAccessService $accessService){}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $openRoutes = ['organisation-admin.inactive', 'organisation-admin.pending-verification'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the org admin
        $orgAdmin = Auth::user()->organisationAdministrator;

        // check if a profile exists
        if(!$orgAdmin) {
            abort('403', 'Access denied.');
        }

        // check if the orgAdmin is not verified
        if(!$orgAdmin->is_verified) {
            return redirect()->route('organisation-admin.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if the org admin is active
        if($orgAdmin->administrator_status !== OrganisationAdministratorStatus::Active) {
            return redirect()->route('organisation-admin.inactive', ['org_id' => $request->route('org_id')]);

        }

        // use the service
        if($this->accessService->adminBelongsToOrganisation(Auth::user(), $request->route('org_id'))) {
            abort(403, 'You do not belong to this organisation');
        }

        // check organisation is active
        $organisation = Organisation::findOrFail($request->route('org_id'));
        if($organisation->organisation_status !== OrganisationStatus::Active) {
            return redirect()->route('manager.inactive', ['org_id' => $request->route('org_id')]);
        }


        return $next($request);
    }
}
