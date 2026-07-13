<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organisation;
use App\Models\OrganisationAdministrator;
use App\Models\OrganisationReporter;
use App\Enums\OrganisationReporterStatus;

class OrganisationReportersSeeder extends Seeder
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

        // create the user
        $userHTH1 = $this->createUser('habbott@happy-to-help.co.uk', 'Hayley', 'Abbot');
        $userHTH2 = $this->createUser('twinwood@happy-to-help.co.uk', 'Tabitha', 'Winward');

        $userAM1 = $this->createUser('jdurrant@achieve-more.co.uk', 'Jake', 'Durrant');
        $userAM2 = $this->createUser('epicton@achieve-more.co.uk', 'Emily', 'Picton');

        // create createOrganisationReporter
        $this->createOrganisationReporter($organisation1, $userHTH1, $orgAdminHTH );
        $this->createOrganisationReporter($organisation1, $userHTH2, $orgAdminHTH );

        $this->createOrganisationReporter($organisation2, $userAM1, $orgAdminAM );
        $this->createOrganisationReporter($organisation2, $userAM2, $orgAdminAM );

    }

    // *** createUser() ***
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

    // *** createOrganisationReporter
    private function createOrganisationReporter(Organisation $organisation, User $user, OrganisationAdministrator $orgAdmin): void {
    $organisationReporter = OrganisationReporter::where('user_id', $user->id)->first();

        if (!$organisationReporter) {
            $organisationReporter = new OrganisationReporter();
            $organisationReporter->user_id = $user->id;
            $organisationReporter->organisation_id = $organisation->id;
            $organisationReporter->is_verified = true;
            $organisationReporter->verified_by_user_id = $orgAdmin->user_id;
            $organisationReporter->verified_at = now();
            $organisationReporter->org_reporter_status = OrganisationReporterStatus::Active;
            $organisationReporter->org_reporter_status_updated_at = now();
            $organisationReporter->org_reporter_status_updated_by_user_id = $orgAdmin->user_id;
            $organisationReporter->save();
        }
    }
}
