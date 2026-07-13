<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organisation;
use App\Models\Home;
use App\Models\Region;
use App\Enums\HomeStatus;

class HomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::where('surname', 'Bowerbank')->first(); // this is the super-admin
        // organisation 1 Achieve More
        $organisation1 = Organisation::where('organisation_name', 'Achieve More')->first();
        // organisation 2 - Happy to Help
        $organisation2 = Organisation::where('organisation_name', 'Happy to Help')->first();

        $region1 = Region::where('organisation_id', $organisation1->id)->first();
        $region2 = Region::where('organisation_id', $organisation2->id)->first();

        

        // home 1 - belongs to Achieve More
        $home1 = Home::firstOrCreate(
            [
                'home_name' => 'Didbury House',
            ],
            [
            'address_1' => 'Didbury Street',
            'city'      =>  'London',
            'postcode'  =>  'SW5 7XD',
            'telephone' =>  '020 125 1245',
            'website_url' => 'https://www.achieve-more.co.uk/homes/didbury-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        $this->attachHomeToOrganisation($home1, $organisation1, $user);
        // $organisation1->homes()->syncWithoutDetaching([
        //     $home1->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home1 = $this->addRegionIdToHome($home1, $region1);


        // home 2 - belongs to Achieve More
        $home2 = Home::firstOrCreate(
            [
                'home_name' => 'Purleigh House',
            ],
            [
            'address_1' => 'Purleigh Avenue',
            'city'      =>  'London',
            'postcode'  =>  'SW2 1BD',
            'telephone' =>  '020 125 1245',
            'website_url' => 'https://www.achieve-more.co.uk/homes/purleigh-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home2, $organisation1, $user);
        // $organisation1->homes()->syncWithoutDetaching([
        //     $home2->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home2 = $this->addRegionIdToHome($home2, $region1);

        
        // home 3 - belongs to Achieve More
        $home3 = Home::firstOrCreate(
            [
                'home_name' => 'Konnect House',
            ],
            [
            'address_1' => 'Stepford Street',
            'city'      =>  'London',
            'postcode'  =>  'SW2 1XX',
            'telephone' =>  '020 125 1247',
            'website_url' => 'https://www.achieve-more.co.uk/homes/konnect-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home3, $organisation1, $user);
        // $organisation1->homes()->syncWithoutDetaching([
        //     $home3->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home3 = $this->addRegionIdToHome($home3, $region1);


        // home 4 - belongs to Achieve More
        $home4 = Home::firstOrCreate(
            [
                'home_name' => 'Bickford House',
            ],
            [
            'address_1' => 'Bickford Road',
            'city'      =>  'London',
            'postcode'  =>  'SW2 1BD',
            'telephone' =>  '020 125 1222',
            'website_url' => 'https://www.achieve-more.co.uk/homes/bickford-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home4, $organisation1, $user);
        // $organisation1->homes()->syncWithoutDetaching([
        //     $home4->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home4 = $this->addRegionIdToHome($home4, $region1);


        // home 5 - belongs to Happy to Help
        $home5 = Home::firstOrCreate(
            [
                'home_name' => 'Wakefield House',
            ],
            [
            'address_1' => 'Wakefield Road',
            'city'      =>  'Manchester',
            'postcode'  =>  'M1 3GG',
            'telephone' =>  '0161 125 1222',
            'website_url' => 'https://www.happy-to-help.co.uk/homes/wakefield-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home5, $organisation2, $user);
        // $organisation2->homes()->syncWithoutDetaching([
        //     $home5->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home5 = $this->addRegionIdToHome($home5, $region2);


        // home 6 - belongs to Happy to Help
        $home6 = Home::firstOrCreate(
            [
                'home_name' => 'Prescott House',
            ],
            [
            'address_1' => 'Prescott Avenue',
            'city'      =>  'Manchester',
            'postcode'  =>  'M4 3TT',
            'telephone' =>  '0161 125 0024',
            'website_url' => 'https://www.happy-to-help.co.uk/homes/prescott-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home6, $organisation2, $user);
        // $organisation2->homes()->syncWithoutDetaching([
        //     $home6->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home6 = $this->addRegionIdToHome($home6, $region2);


        // home 7 - belongs to Happy to Help
        $home7 = Home::firstOrCreate(
            [
                'home_name' => 'Gaskell House',
            ],
            [
            'address_1' => 'Gaskell Street',
            'city'      =>  'Manchester',
            'postcode'  =>  'M2 5TX',
            'telephone' =>  '0161 125 0026',
            'website_url' => 'https://www.happy-to-help.co.uk/homes/gaskell-house/',
            'created_by_user_id' => $user->id,
            'home_status' => HomeStatus::Active,

        ]);

        // attach home to organisation
        // avoid duplicate rows by using syncWithoutDetaching
        $this->attachHomeToOrganisation($home7, $organisation2, $user);
        // $organisation2->homes()->syncWithoutDetaching([
        //     $home7->id => [
        //     'started_at' => now(),
        //     'created_by_user_id' => $user->id,
        // ]]);

        // add the region id
        $home7 = $this->addRegionIdToHome($home7, $region2);



    }

    // *** addRegionIdToHome() ***
    private function addRegionIdToHome($home, $region):Home {
        if($home->region_id === null) {
            $home->region_id = $region->id;
            $home->save();
            return $home;

        } else {
            return $home;
        }
    }

    // *** attachHomeToOrganisation() ***
    private function attachHomeToOrganisation(Home $home, Organisation $organisation, User $user): void {
        $alreadyAttached = $organisation->homes()
            ->where('home_id', $home->id)
            ->exists();

        if (!$alreadyAttached) {
            $organisation->homes()->attach($home->id, [
                'started_at' => now(),
                'created_by_user_id' => $user->id,
            ]);
        }
    }
}
