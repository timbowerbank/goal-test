<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organisation;
use App\Models\OrganisationAdministrator;
use App\Models\Region;
use App\Models\RegionalOperator;
use App\Enums\RegionalOperatorStatus;


class RegionalOperatorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // org admins
        // North West Manchester based
        $organisation1 = Organisation::where('organisation_name', 'Happy to Help')->first();
        $orgAdminHTH = $organisation1->administrators()->first();
        // South East London based
        $organisation2 = Organisation::where('organisation_name', 'Achieve More')->first();
        $orgAdminAM = $organisation2->administrators()->first();

        // regions
        // North West
        $regionHTH = Region::where('organisation_id', $organisation1->id)->where('name', 'North West')->first();
        // South East
        $regionAM = Region::where('organisation_id', $organisation2->id)->where('name', 'South East')->first();

        // create the user
        $userHTH1 = $this->createUser('ccoley@happy-to-help.co.uk', 'Clare', 'Coley');
        $userHTH2 = $this->createUser('dcoulson@happy-to-help.co.uk', 'David', 'Coulson');

        $userAM1 = $this->createUser('thibbert@achieve-more.co.uk', 'Tanya', 'Hibbert');
        $userAM2 = $this->createUser('stalbot@achieve-more.co.uk', 'Samuel', 'Talbot');

        // create the regional operator
        $regionalOpHTH1 = $this->createRegionalOperator($userHTH1, $orgAdminHTH);
        $regionalOpHTH2 = $this->createRegionalOperator($userHTH2, $orgAdminHTH);

        $regionalOpAM1 = $this->createRegionalOperator($userAM1, $orgAdminAM);
        $regionalOpAM2 = $this->createRegionalOperator($userAM2, $orgAdminAM);

        // attach regional operator to region
        $this->attachRegionalOperatorToRegion($regionalOpHTH1, $regionHTH, $orgAdminHTH);
        $this->attachRegionalOperatorToRegion($regionalOpHTH2, $regionHTH, $orgAdminHTH);

        $this->attachRegionalOperatorToRegion($regionalOpAM1, $regionAM, $orgAdminAM);
        $this->attachRegionalOperatorToRegion($regionalOpAM2, $regionAM, $orgAdminAM);


    }

    // create a user
    private function createUser(string $email, string $firstName, string $surname):User {

        $user = User::firstOrCreate(
            [
                'email' => $email
            ], 
            [
                'first_name' => $firstName,
                'surname' => $surname,
                'password' => env('REGIONAL_OPERATOR_PASSWORD'),
            ]);

        if($user->wasRecentlyCreated) {
            $user->email_verified_at = now();
            $user->save();
        }
        return $user;

    }

    // *** createRegionalOperator() ***
    private function createRegionalOperator(User $user, OrganisationAdministrator $orgAdmin):RegionalOperator {
        $regionalOperator = RegionalOperator::firstOrCreate(
            [
                'user_id' => $user->id 
            ]);
        if($regionalOperator->wasRecentlyCreated) {

            $regionalOperator->is_verified = true;
            $regionalOperator->verified_at = now();
            $regionalOperator->verified_by_user_id = $orgAdmin->user_id;
            $regionalOperator->ro_status = RegionalOperatorStatus::Active;
            $regionalOperator->ro_status_updated_at = now();
            $regionalOperator->ro_status_updated_by_user_id = $orgAdmin->user_id;
            $regionalOperator->save();
        }

        return $regionalOperator;
    }

    // *** attachRegionalOperatorToRegion ***
    private function attachRegionalOperatorToRegion(RegionalOperator $regionalOperator, Region $region, OrganisationAdministrator $orgAdmin):void {
        $alreadyAttached = $region->regionalOperators()
            ->where('regional_operator_id', $regionalOperator->id)
            ->exists();

        if (!$alreadyAttached) {
            $region->regionalOperators()->attach($regionalOperator->id, [
                'started_at' => now(),
                'created_by_user_id' => $orgAdmin->user_id,
            ]);
        }
    }
}
