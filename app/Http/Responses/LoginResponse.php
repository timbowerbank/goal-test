<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function toResponse($request) {
        $user = auth()->user();

        if($user->superAdmin) {
            return redirect()->route('super-admin.dashboard');
        }

        if($user->organisationAdministrator) {
            $org = $user->organisationAdministrator->organisation;
            return redirect()->route('organisation-admin.dashboard', [
                'org_id' => $org->id,
            ]);
        }

        if($user->regionalOperator) {
            $region = $user->regionalOperator->regions()->first();
            if (!$region) {
                // no region assigned yet — decide what should happen here
                abort(403, 'No region has been assigned to your account yet.');
            }

            $org = $region->organisation;
            return redirect()->route('regional-operator.dashboard', [
                'org_id' => $org->id,
            ]);
        }

        if($user->organisationReporter) {
            $org = $user->organisationReporter->organisation;
            return redirect()->route('organisation-reporter.dashboard', ['org_id' => $org->id]);
        }

        if($user->manager) {
            $home = $user->manager->homes()->first();
            $org = $home->organisations()->first();
            
            return redirect()->route('manager.dashboard', [
                'org_id' => $org->id
            ]);
        }

        if($user->carer) {
            $home = $user->carer->homes()->first();
            $org = $home->organisations()->first();
            return redirect()->route('carer.dashboard', [
                'org_id' => $org->id 
            ]);
        }

        if($user->client) {
            $home = $user->client->home;
            $org = $home->organisations()->first();
            return redirect()->route('client.dashboard', [
                'org_id' => $org->id
            ]);
        }

        if($user->familyFriend) {
            return redirect()->route('family-friend.dashboard');
        }

        return redirect()->route('login');
    }
}
