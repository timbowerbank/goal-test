<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Home;
use App\Models\Manager;
use \App\Enums\ManagerStatus;

class ManagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminUser = User::where('surname', 'Bowerbank')->first();

        $home1 = Home::where('home_name', 'Didbury House')->first();
        $home2 = Home::where('home_name', 'Purleigh House')->first();
        $home3 = Home::where('home_name', 'Konnect House')->first();
        $home4 = Home::where('home_name', 'Bickford House')->first();
        $home5 = Home::where('home_name', 'Wakefield House')->first();
        $home6 = Home::where('home_name', 'Prescott House')->first();
        $home7 = Home::where('home_name', 'Gaskell House')->first();

        // *** Didbury House managers ***
        $user1 = $this->createUser('jjones@achieve-more.co.uk', 'Jenny', 'Jones');
        $manager1 = $this->createManager($superAdminUser, $user1);
        $this->attachManagerToHome($home1, $manager1, $superAdminUser);

        $user2 = $this->createUser('bsmith@achieve-more.co.uk', 'Bob', 'Smith');
        $manager2 = $this->createManager($superAdminUser, $user2);
        $this->attachManagerToHome($home1, $manager2, $superAdminUser);

        // *** Purleigh House managers ***
        $user3 = $this->createUser('pwilliams@achieve-more.co.uk', 'Paul', 'Williams');
        $manager3 = $this->createManager($superAdminUser, $user3);
        $this->attachManagerToHome($home2, $manager3, $superAdminUser);

        $user4 = $this->createUser('sbrown@achieve-more.co.uk', 'Sarah', 'Brown');
        $manager4 = $this->createManager($superAdminUser, $user4);
        $this->attachManagerToHome($home2, $manager4, $superAdminUser);

        // *** Konnect House managers ***
        $user5 = $this->createUser('dtaylor@achieve-more.co.uk', 'David', 'Taylor');
        $manager5 = $this->createManager($superAdminUser, $user5);
        $this->attachManagerToHome($home3, $manager5, $superAdminUser);

        $user6 = $this->createUser('lwilson@achieve-more.co.uk', 'Laura', 'Wilson');
        $manager6 = $this->createManager($superAdminUser, $user6);
        $this->attachManagerToHome($home3, $manager6, $superAdminUser);

        // *** Bickford House managers ***
        $user7 = $this->createUser('mthomas@achieve-more.co.uk', 'Mark', 'Thomas');
        $manager7 = $this->createManager($superAdminUser, $user7);
        $this->attachManagerToHome($home4, $manager7, $superAdminUser);

        $user8 = $this->createUser('ejackson@achieve-more.co.uk', 'Emma', 'Jackson');
        $manager8 = $this->createManager($superAdminUser, $user8);
        $this->attachManagerToHome($home4, $manager8, $superAdminUser);

        // *** Wakefield House managers ***
        $user9 = $this->createUser('rwhite@happy-to-help.co.uk', 'Rachel', 'White');
        $manager9 = $this->createManager($superAdminUser, $user9);
        $this->attachManagerToHome($home5, $manager9, $superAdminUser);

        $user10 = $this->createUser('jharris@happy-to-help.co.uk', 'James', 'Harris');
        $manager10 = $this->createManager($superAdminUser, $user10);
        $this->attachManagerToHome($home5, $manager10, $superAdminUser);

        // *** Prescott House managers ***
        $user11 = $this->createUser('amartin@happy-to-help.co.uk', 'Alice', 'Martin');
        $manager11 = $this->createManager($superAdminUser, $user11);
        $this->attachManagerToHome($home6, $manager11, $superAdminUser);

        $user12 = $this->createUser('cthompson@happy-to-help.co.uk', 'Chris', 'Thompson');
        $manager12 = $this->createManager($superAdminUser, $user12);
        $this->attachManagerToHome($home6, $manager12, $superAdminUser);

        // *** Gaskell House managers ***
        $user13 = $this->createUser('nrobinson@happy-to-help.co.uk', 'Natalie', 'Robinson');
        $manager13 = $this->createManager($superAdminUser, $user13);
        $this->attachManagerToHome($home7, $manager13, $superAdminUser);

        $user14 = $this->createUser('kclark@happy-to-help.co.uk', 'Kevin', 'Clark');
        $manager14 = $this->createManager($superAdminUser, $user14);
        $this->attachManagerToHome($home7, $manager14, $superAdminUser);

        
    }

    // *** createUser() ***
    private function createUser(string $email, string $firstName, string $surname): User {
        $user = User::firstOrCreate([
            'email' => $email,
        ],
        [
            'first_name' => $firstName,
            'surname' => $surname,
            'password' => env('MANAGER_PASSWORD'),
        ]);
        $user->email_verified_at = now();
        $user->save();
        return $user;
    }


    // *** createManager() ***
    // helper function for creating a manager
    private function createManager(User $superAdminUser, User $user): Manager {
        $manager = Manager::firstOrCreate(['user_id' => $user->id]);
        $manager->is_verified = true;
        $manager->verified_by_user_id = $superAdminUser->id;
        $manager->verified_at = now();
        $manager->manager_status = ManagerStatus::Active;
        $manager->manager_status_updated_at = now();
        $manager->manager_status_updated_by_user_id = $superAdminUser->id;
        $manager->save();
        return $manager;
    }

    // *** attachManagerToHome() ***
    private function attachManagerToHome(Home $home, Manager $manager, User $superAdminUser): void {
        $home->managers()->syncWithoutDetaching([
            $manager->id => [
                'started_at' => now(),
                'created_by_user_id' => $superAdminUser->id,
            ]
        ]);
    }
}
