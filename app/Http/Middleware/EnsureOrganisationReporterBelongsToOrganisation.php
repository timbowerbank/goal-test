<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\OrganisationAccessService;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrganisationReporterStatus;

class EnsureOrganisationReporterBelongsToOrganisation
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

        $openRoutes = ['organisation-reporter.pending-verification', 'organisation-reporter.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the organisationReporter
        $organisationReporter = $user->organisationReporter;

        // check if a organisationReporter  profile exists
        if(!$organisationReporter) {
            abort(403, 'Access denied.');
        }

        // check if they belong to this organisation
        if(!$this->accessService->organisationReporterBelongsToOrganisation($user, $request->route('org_id'))) {
            abort(403, 'You do not belong to this organisation.');
        }

        // check if organisationReporter is not verified
        if(!$organisationReporter->is_verified) {
            return redirect()->route('organisation-reporter.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if organisationReporter is active
        if($organisationReporter->org_reporter_status !== OrganisationReporterStatus::Active) {
            return redirect()->route('organisation-reporter.inactive', ['org_id' => $request->route('org_id')]);
        }

        return $next($request);
    }
}
