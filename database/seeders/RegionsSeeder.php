<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organisation;
use App\Models\Region;
use App\Models\OrganisationAdministrator;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get organisation1
        $organisation1 = Organisation::where('organisation_name', 'Happy to Help')->first();
        // organisation admin for organisation1
        $org1AdminUser = $organisation1->administrators()->first();

        // get organisation2
        $organisation2 = Organisation::where('organisation_name', 'Achieve More')->first();
        // organisation admin for organisation1
        $org2AdminUser = $organisation2->administrators()->first();

        // invoke createRegion
        $this->createRegion($organisation1, 'South East', $org1AdminUser);
        $this->createRegion($organisation2, 'North West', $org2AdminUser);
    }


    // *** createRegion() ***
    private function createRegion(
        Organisation $organisation, 
        string $name,
        OrganisationAdministrator $orgAdmin):void {

        // check if a region exists first for an organisation
        $region = Region::where('organisation_id', $organisation->id)
                ->where('name', $name)->first();

        // if the region doesn't exist then create it
        if(!$region) {
            $region = new Region();
            $region->organisation_id = $organisation->id;
            $region->name = $name;
            $region->created_by_user_id = $orgAdmin->user_id;
            $region->save();
        }
    }


}
