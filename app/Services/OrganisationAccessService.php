<?php

namespace App\Services;

use App\Models\User;
use App\Enums\ManagerStatus;
use App\Enums\CarerStatus;
use App\Enums\ClientStatus;

class OrganisationAccessService {

    // *** managerBelongsToOrganisation() ***
    public function managerBelongsToOrganisation(User $user, int $org_id) {

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
    public function carerBelongsToOrganisation(User $user, int $org_id) {
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
    public function clientBelongsToOrganisation(User $user, int $org_id) {
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
}