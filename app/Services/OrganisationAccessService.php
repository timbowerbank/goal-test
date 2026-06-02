<?php

namespace App\Services;

use App\Models\User;
use App\Enums\ManagerStatus;
use App\Enums\CarerStatus;
use App\Enums\ClientStatus;
use App\Enums\OrganisationAdministratorStatus;

class OrganisationAccessService {

    // *** managerBelongsToOrganisation() ***
    public function managerBelongsToOrganisation(User $user, string $org_id) {

        $manager = $user->manager;

        // check manager is in the manager table
        if(!$manager) {
            return false;
        }

        // check they are verified
        if(!$manager->is_verified){
            return false;
        }

        // check the manager is active
        if($manager->manager_status !== ManagerStatus::Active) {
            return false;
        }

        // must have an active home in the requested organisation
        return $manager->homes()
                ->wherePivotNull('ended_at')
                ->whereHas('organisation', function($query) use ($org_id){
                    $query->where('organisations.id', $org_id);
                })
                ->exists();
    }

    // *** carerBelongsToOrganisation() ***
    public function carerBelongsToOrganisation(User $user, string $org_id) {
        // get the carer
        $carer = $user->carer;

        // check if the carer exists
        if(!$carer) {
            return false;
        }

        // check that the carer is verified
        if(!$carer->is_verified) {
            return false;
        }

        if($carer->carer_status !== CarerStatus::Active) {
            return false;
        }

        return $carer->homes()
            ->wherePivotNull('ended_at')
            ->whereHas('organisation', function($query) use ($org_id){
                    $query->where('organisations.id', $org_id);
                })
            ->exists();
    }

    // *** clientBelongsToOrganisation() ***
    public function clientBelongsToOrganisation(User $user, string $org_id) {
        // get the client
        $client = $user->client;

        // check if client exists
        if(!$client) {
            return false;
        }

        // check that the client is verified
        if(!$client->is_verified) {
            return false;
        }

        // check that the client is active
        if($client->clientStatus !== ClientStatus::Active) {
            return false;
        }

        // check that the client has a home
        return $client->home()
            ->whereHas('organisation', function($query) use ($org_id){
                $query->where('organisations.id', $org_id);
            })
            ->exists();
    }

    public function adminBelongsToOrganisation(User $user, string $org_id) {
        // get the admin
        $admin = $user->organisationAdministrator;

        // check admin is valid
        if(!$admin) {
            return false;
        }

        // check the admin is verified
        if(!$admin->is_verified) {
            return false;
        }

        // check the status of the admin
        if($admin->administrator_status !== OrganisationAdministratorStatus::Active) {
            return false;
        }

        // check that the administrator has an organisation
        if($admin->organisation_id !== $org_id) {
            return false;
        }

        return true;


    }
}