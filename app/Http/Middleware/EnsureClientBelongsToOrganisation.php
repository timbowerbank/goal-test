<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Enums\ClientStatus;
use App\Services\OrganisationAccessService;
use App\Enums\OrganisationStatus;
use App\Models\Organisation;

class EnsureClientBelongsToOrganisation
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
        // allow the following routes to bypass checks
        $openRoutes = ['client.pending-verification', 'client.inactive'];
        if(in_array($request->route()->getName(), $openRoutes)) {
            return $next($request);
        }

        // get the client
        $client = Auth::user()->client;

        // check if a client
        if(!$client) {
            abort(403, 'Access denied.');
        }

        // check if verified
        if(!$client->is_verified) {
            return redirect()->route('client.pending-verification', ['org_id' => $request->route('org_id')]);
        }

        // check if not active
        if($client->client_status !== ClientStatus::Active) {
            return redirect()->route('client.inactive', ['org_id' => $request->route('org_id')]);
        }

        // check if the client belongs to the organisation
        if(!$this->accessService->clientBelongsToOrganisation(Auth::user(), $request->route('org_id'))) {
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
