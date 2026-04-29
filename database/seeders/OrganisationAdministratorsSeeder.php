<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organisation;
use App\Models\OrganisationAdministrator;
use App\Enums\OrganisationAdministratorStatus;


class OrganisationAdministratorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::where('surname', 'Bowerbank')->first();

        $organisation1 = Organisation::where('organisation_name', 'Achieve More')->first();
        $organisation2 = Organisation::where('organisation_name', 'Happy to Help')->first();

        // create two users per organisation
        $user1 = $this->createUser('talbright@achieve-more.co.uk', 'Tamsin', 'Albright');
        $this->createOrganisationAdministrator($user1, $superAdmin, $organisation1);

        $user2 = $this->createUser('jaddinson@achieve-more.co.uk', 'James', 'Addinson');
        $this->createOrganisationAdministrator($user2, $superAdmin, $organisation1);

        $user3 = $this->createUser('fbelkin@happy-to-help.co.uk', 'Francis', 'Belkin');
        $this->createOrganisationAdministrator($user3, $superAdmin, $organisation2);

        $user4 = $this->createUser('jdibble@happy-to-help.co.uk', 'Jenny', 'Dibble');
        $this->createOrganisationAdministrator($user4, $superAdmin, $organisation2);
    }

    private function createUser(string $email, string $firstName, string $surname):User {
        $user = User::firstOrCreate([
            'email' => $email
        ], [
            'first_name' => $firstName,
            'surname' => $surname,
            'password' => env('ORGANISATION_ADMIN_PASSWORD')
        ]);
        $user->email_verified_at = now();
        $user->save();
        return $user;
    }

    private function createOrganisationAdministrator(User $user, User $superAdmin, Organisation $organisation): OrganisationAdministrator {
        $orgAdmin = OrganisationAdministrator::firstOrCreate([
            'user_id' => $user->id,
            'organisation_id' => $organisation->id,
        ]);
        $orgAdmin->is_verified = true;
        $orgAdmin->verified_by_user_id = $superAdmin->id;
        $orgAdmin->verified_at = now();
        $orgAdmin->administrator_status = OrganisationAdministratorStatus::Active;
        $orgAdmin->status_updated_at = now();
        $orgAdmin->status_updated_by_user_id = $user->id;
        $orgAdmin->save();
        return $orgAdmin;

    }
}
