<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\OrganisationStatus;
use \App\Models\Organisation;
use \App\Models\User;

class OrganisationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('surname', 'Bowerbank')->first(); // this is the super-admin

        // create the first organisation
        Organisation::firstOrCreate(
        [
            'organisation_name' => 'Achieve More',
        ],    
        [
            'address_1' => '1 Better Street',
            'city' => 'London',
            'postcode' => 'SW7 6BD',
            'telephone' => '020 211 4040',
            'website_url' => 'https://www.achieve-more.co.uk',
            'created_by_user_id' => $user->id,
            'organisation_status' => OrganisationStatus::Active,

        ]);

        // create the second organisation
        Organisation::firstOrCreate(
        [
            'organisation_name' => 'Happy to Help',
        ],    
        [
            'address_1' => '2 Glow Street',
            'city' => 'Manchester',
            'postcode' => 'M2 3GX',
            'telephone' => '0161 822 2564',
            'website_url' => 'https://www.happy-to-help.co.uk',
            'created_by_user_id' => $user->id,
            'organisation_status' => OrganisationStatus::Active,

        ]);
    }
}
