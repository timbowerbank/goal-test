<?php

namespace App\Services;

use App\Models\User;
use App\Enums\ManagerStatus;
use App\Enums\CarerStatus;
use App\Enums\ClientStatus;
use App\Enums\OrganisationAdministratorStatus;
use App\Enums\OrganisationStatus;
use App\Enums\RegionalOperatorStatus;
use App\Enums\OrganisationReporterStatus;

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
                ->whereHas('organisations', function($query) use ($org_id){
                    $query  ->where('organisations.id', $org_id)
                            ->where('organisations.organisation_status', OrganisationStatus::Active);
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

        // check carer is active
        if($carer->carer_status !== CarerStatus::Active) {
            return false;
        }

        return $carer->homes()
            ->wherePivotNull('ended_at')
            ->whereHas('organisations', function($query) use ($org_id){
                    $query  ->where('organisations.id', $org_id)
                            ->where('organisations.organisation_status', OrganisationStatus::Active);
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
        if($client->client_status !== ClientStatus::Active) {
            return false;
        }

        // check that the client has a home
        return $client->home()
            ->whereHas('organisations', function($query) use ($org_id){
                $query  ->where('organisations.id', $org_id)
                        ->where('organisations.organisation_status', OrganisationStatus::Active);
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

    public function regionalOperatorBelongsToOrganisation(User $user, string $org_id) {
        // get the regionalOperator
        $regionalOperator = $user->regionalOperator;

        // check regionalOperator is valid
        if(!$regionalOperator) {
            return false;
        }

        // check the regionalOperator is verified
        if(!$regionalOperator->is_verified) {
            return false;
        }

        // check the status of the regionalOperator
        if($regionalOperator->ro_status !== RegionalOperatorStatus::Active) {
            return false;
        }

        // check that the regionalOperator has an organisation
        return $regionalOperator->regions()
            ->wherePivotNull('ended_at')
            ->whereHas('organisation', function($query) use ($org_id){
                $query  ->where('organisations.id', $org_id)
                        ->where('organisations.organisation_status', OrganisationStatus::Active);
            })
            ->exists();

    }


    public function organisationReporterBelongsToOrganisation(User $user, string $org_id) {
        // get the organisationReporter
        $organisationReporter = $user->organisationReporter;

        // check organisationReporter is valid
        if(!$organisationReporter) {
            return false;
        }

        // check the organisationReporter is verified
        if(!$organisationReporter->is_verified) {
            return false;
        }

        // check the status of the organisationReporter
        if($organisationReporter->org_reporter_status !== OrganisationReporterStatus::Active) {
            return false;
        }

        // check that the organisationReporter has an active organisation
        return $organisationReporter->organisation->id === $org_id
            && $organisationReporter->organisation->organisation_status === OrganisationStatus::Active;

    }
}