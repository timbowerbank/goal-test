<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manager;
use App\Models\Carer;
use App\Models\Home;
use App\Enums\CarerStatus;

class CarersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Achieve More managers
        $manager1 = Manager::whereHas('user', function($query) {
            $query->where('email', 'jjones@achieve-more.co.uk');
        })->first();
        $manager2 = Manager::whereHas('user', function($query) {
            $query->where('email', 'pwilliams@achieve-more.co.uk');
        })->first();
        $manager3 = Manager::whereHas('user', function($query) {
            $query->where('email', 'dtaylor@achieve-more.co.uk');
        })->first();


        // Happy to Help managers
        $manager4 = Manager::whereHas('user', function($query) {
            $query->where('email', 'mthomas@achieve-more.co.uk');
        })->first();
        $manager5 = Manager::whereHas('user', function($query) {
            $query->where('email', 'rwhite@happy-to-help.co.uk');
        })->first();
        $manager6 = Manager::whereHas('user', function($query) {
            $query->where('email', 'amartin@happy-to-help.co.uk');
        })->first();
        $manager7 = Manager::whereHas('user', function($query) {
            $query->where('email', 'nrobinson@happy-to-help.co.uk');
        })->first();


        // home 1 - organisation Achieve More
        $home1 = Home::where('home_name', 'Didbury House')->first();
        // home 2 - organisation Achieve More
        $home2 = Home::where('home_name', 'Purleigh House')->first();
        // home 3 - organisation Achieve More
        $home3 = Home::where('home_name', 'Konnect House')->first();

        // home 4 - organisation Happy to Help
        $home4 = Home::where('home_name', 'Bickford House')->first();
        // home 5 - organisation Happy to Help
        $home5 = Home::where('home_name', 'Wakefield House')->first();
        // home 6 - organisation Happy to Help
        $home6 = Home::where('home_name', 'Prescott House')->first();
        // home 7 - organisation Happy to Help
        $home7 = Home::where('home_name', 'Gaskell House')->first(); 


        // create carer1 for Didbury House
        $user1 = $this->createUser('badams@achieve-more.co.uk', 'Ben', 'Adams');
        $carer1 = $this->createCarer($user1, $manager1);
        $this->attachCarerToHome($carer1, $home1, $manager1);

        // create carer2 for Didbury House
        $user2 = $this->createUser('swilliams@achieve-more.co.uk', 'Sian', 'Williams');
        $carer2 = $this->createCarer($user2, $manager1);
        $this->attachCarerToHome($carer2, $home1, $manager1);

        $user3 = $this->createUser('kbrown@achieve-more.co.uk', 'Katie', 'Brown');
        $carer3 = $this->createCarer($user3, $manager1);
        $this->attachCarerToHome($carer3, $home1, $manager1);

        // *** Purleigh House carers ***
        $user4 = $this->createUser('rjohnson@achieve-more.co.uk', 'Ryan', 'Johnson');
        $carer4 = $this->createCarer($user4, $manager2);
        $this->attachCarerToHome($carer4, $home2, $manager2);

        $user5 = $this->createUser('lthomas@achieve-more.co.uk', 'Lisa', 'Thomas');
        $carer5 = $this->createCarer($user5, $manager2);
        $this->attachCarerToHome($carer5, $home2, $manager2);

        $user6 = $this->createUser('dmartin@achieve-more.co.uk', 'Dean', 'Martin');
        $carer6 = $this->createCarer($user6, $manager2);
        $this->attachCarerToHome($carer6, $home2, $manager2);

        // *** Konnect House carers ***
        $user7 = $this->createUser('hjackson@achieve-more.co.uk', 'Hannah', 'Jackson');
        $carer7 = $this->createCarer($user7, $manager3);
        $this->attachCarerToHome($carer7, $home3, $manager3);

        $user8 = $this->createUser('owhite@achieve-more.co.uk', 'Oliver', 'White');
        $carer8 = $this->createCarer($user8, $manager3);
        $this->attachCarerToHome($carer8, $home3, $manager3);

        $user9 = $this->createUser('aharris@achieve-more.co.uk', 'Amy', 'Harris');
        $carer9 = $this->createCarer($user9, $manager3);
        $this->attachCarerToHome($carer9, $home3, $manager3);

        // *** Bickford House carers ***
        $user10 = $this->createUser('jtaylor@achieve-more.co.uk', 'Jake', 'Taylor');
        $carer10 = $this->createCarer($user10, $manager4);
        $this->attachCarerToHome($carer10, $home4, $manager4);

        $user11 = $this->createUser('emorris@achieve-more.co.uk', 'Emily', 'Morris');
        $carer11 = $this->createCarer($user11, $manager4);
        $this->attachCarerToHome($carer11, $home4, $manager4);

        $user12 = $this->createUser('cwilson@achieve-more.co.uk', 'Craig', 'Wilson');
        $carer12 = $this->createCarer($user12, $manager4);
        $this->attachCarerToHome($carer12, $home4, $manager4);

        // *** Wakefield House carers ***
        $user13 = $this->createUser('sroberts@happy-to-help.co.uk', 'Sophie', 'Roberts');
        $carer13 = $this->createCarer($user13, $manager5);
        $this->attachCarerToHome($carer13, $home5, $manager5);

        $user14 = $this->createUser('mevans@happy-to-help.co.uk', 'Matt', 'Evans');
        $carer14 = $this->createCarer($user14, $manager5);
        $this->attachCarerToHome($carer14, $home5, $manager5);

        $user15 = $this->createUser('zclark@happy-to-help.co.uk', 'Zoe', 'Clark');
        $carer15 = $this->createCarer($user15, $manager5);
        $this->attachCarerToHome($carer15, $home5, $manager5);

        // *** Prescott House carers ***
        $user16 = $this->createUser('jwalker@happy-to-help.co.uk', 'Josh', 'Walker');
        $carer16 = $this->createCarer($user16, $manager6);
        $this->attachCarerToHome($carer16, $home6, $manager6);

        $user17 = $this->createUser('nhill@happy-to-help.co.uk', 'Nicola', 'Hill');
        $carer17 = $this->createCarer($user17, $manager6);
        $this->attachCarerToHome($carer17, $home6, $manager6);

        $user18 = $this->createUser('tscott@happy-to-help.co.uk', 'Tom', 'Scott');
        $carer18 = $this->createCarer($user18, $manager6);
        $this->attachCarerToHome($carer18, $home6, $manager6);

        // *** Gaskell House carers ***
        $user19 = $this->createUser('pgreen@happy-to-help.co.uk', 'Phoebe', 'Green');
        $carer19 = $this->createCarer($user19, $manager7);
        $this->attachCarerToHome($carer19, $home7, $manager7);

        $user20 = $this->createUser('badams@happy-to-help.co.uk', 'Brian', 'Adams');
        $carer20 = $this->createCarer($user20, $manager7);
        $this->attachCarerToHome($carer20, $home7, $manager7);

        $user21 = $this->createUser('lcarter@happy-to-help.co.uk', 'Lucy', 'Carter');
        $carer21 = $this->createCarer($user21, $manager7);
        $this->attachCarerToHome($carer21, $home7, $manager7);
        

    }

    private function createUser(string $email, string $firstName, string $surname): User {
        $user = User::firstOrCreate(
            [
                'email' => $email, 
            ], 
            [
                'first_name' => $firstName,
                'surname' => $surname,
                'password' => env('CARER_PASSWORD'),
            ]);

        $user->email_verified_at = now();
        $user->save();
        return $user;
    }


    private function createCarer(User $user, Manager $manager): Carer {
        $carer = Carer::firstOrCreate(
            [
                'user_id' => $user->id
            ]);
        $carer->user_id = $user->id;
        $carer->is_verified = true;
        $carer->verified_at = now();
        $carer->verified_by_user_id = $manager->user_id;
        $carer->carer_status = CarerStatus::Active;
        $carer->carer_status_updated_at = now();
        $carer->carer_status_updated_by_user_id = $manager->user_id;
        $carer->save();

        return $carer;
    }

    private function attachCarerToHome(Carer $carer, Home $home, Manager $manager): void {
        $home->carers()->syncWithoutDetaching(
            [$carer->id => [
                'started_at' => now(),
                'created_by_user_id' => $manager->user_id,
            ]
            
            ]);
    }
}
