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

        if($user->manager) {
            $home = $user->manager->homes()->first();
            $org = $home->organisation()->first();
            
            return redirect()->route('manager.dashboard', [
                'org_id' => $org->id
            ]);
        }

        if($user->carer) {
            $home = $user->carer->homes()->first();
            $org = $home->organisation()->first();
            return redirect()->route('carer.dashboard', [
                'org_id' => $org->id 
            ]);
        }

        if($user->client) {
            $home = $user->client->home;
            $org = $home->organisation()->first();
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
