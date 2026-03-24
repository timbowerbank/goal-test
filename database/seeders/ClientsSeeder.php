<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manager;
use App\Models\Client;
use App\Models\Home;
use App\Enums\ClientStatus;

class ClientsSeeder extends Seeder
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

        // create clients x 5 per house

        $user1 = $this->createUser('jjones@gmail.com', 'Jackie', 'Jones');
        $this->createClient($user1, $manager1, $home1);

        $user2 = $this->createUser('msmith@gmail.com', 'Michael', 'Smith');
        $this->createClient($user2, $manager1, $home1);

        $user3 = $this->createUser('sbrown@gmail.com', 'Sarah', 'Brown');
        $this->createClient($user3, $manager1, $home1);

        $user4 = $this->createUser('dtaylor@gmail.com', 'David', 'Taylor');
        $this->createClient($user4, $manager1, $home1);

        $user5 = $this->createUser('ewilson@gmail.com', 'Emma', 'Wilson');
        $this->createClient($user5, $manager1, $home1);

        // *** Purleigh House clients ***
        $user6 = $this->createUser('rwhite@gmail.com', 'Ryan', 'White');
        $this->createClient($user6, $manager2, $home2);

        $user7 = $this->createUser('lharris@gmail.com', 'Laura', 'Harris');
        $this->createClient($user7, $manager2, $home2);

        $user8 = $this->createUser('jmartin@gmail.com', 'James', 'Martin');
        $this->createClient($user8, $manager2, $home2);

        $user9 = $this->createUser('athompson@gmail.com', 'Alice', 'Thompson');
        $this->createClient($user9, $manager2, $home2);

        $user10 = $this->createUser('crobinson@gmail.com', 'Chris', 'Robinson');
        $this->createClient($user10, $manager2, $home2);

        // *** Konnect House clients ***
        $user11 = $this->createUser('nclark@gmail.com', 'Natalie', 'Clark');
        $this->createClient($user11, $manager3, $home3);

        $user12 = $this->createUser('kwalker@gmail.com', 'Kevin', 'Walker');
        $this->createClient($user12, $manager3, $home3);

        $user13 = $this->createUser('phill@gmail.com', 'Phoebe', 'Hill');
        $this->createClient($user13, $manager3, $home3);

        $user14 = $this->createUser('tscott@gmail.com', 'Tom', 'Scott');
        $this->createClient($user14, $manager3, $home3);

        $user15 = $this->createUser('zgreen@gmail.com', 'Zoe', 'Green');
        $this->createClient($user15, $manager3, $home3);

        // *** Bickford House clients ***
        $user16 = $this->createUser('badams@gmail.com', 'Brian', 'Adams');
        $this->createClient($user16, $manager4, $home4);

        $user17 = $this->createUser('lcarter@gmail.com', 'Lucy', 'Carter');
        $this->createClient($user17, $manager4, $home4);

        $user18 = $this->createUser('sroberts@gmail.com', 'Simon', 'Roberts');
        $this->createClient($user18, $manager4, $home4);

        $user19 = $this->createUser('nevans@gmail.com', 'Nina', 'Evans');
        $this->createClient($user19, $manager4, $home4);

        $user20 = $this->createUser('jturner@gmail.com', 'Jack', 'Turner');
        $this->createClient($user20, $manager4, $home4);

        // *** Wakefield House clients ***
        $user21 = $this->createUser('aphillips@gmail.com', 'Amy', 'Phillips');
        $this->createClient($user21, $manager5, $home5);

        $user22 = $this->createUser('gcampbell@gmail.com', 'George', 'Campbell');
        $this->createClient($user22, $manager5, $home5);

        $user23 = $this->createUser('hparker@gmail.com', 'Holly', 'Parker');
        $this->createClient($user23, $manager5, $home5);

        $user24 = $this->createUser('omitchell@gmail.com', 'Owen', 'Mitchell');
        $this->createClient($user24, $manager5, $home5);

        $user25 = $this->createUser('rmorgan@gmail.com', 'Rachel', 'Morgan');
        $this->createClient($user25, $manager5, $home5);

        // *** Prescott House clients ***
        $user26 = $this->createUser('dcooper@gmail.com', 'Daniel', 'Cooper');
        $this->createClient($user26, $manager6, $home6);

        $user27 = $this->createUser('irichards@gmail.com', 'Isabella', 'Richards');
        $this->createClient($user27, $manager6, $home6);

        $user28 = $this->createUser('mward@gmail.com', 'Matthew', 'Ward');
        $this->createClient($user28, $manager6, $home6);

        $user29 = $this->createUser('fgraham@gmail.com', 'Fiona', 'Graham');
        $this->createClient($user29, $manager6, $home6);

        $user30 = $this->createUser('bstewart@gmail.com', 'Benjamin', 'Stewart');
        $this->createClient($user30, $manager6, $home6);

        // *** Gaskell House clients ***
        $user31 = $this->createUser('chellis@gmail.com', 'Charlotte', 'Ellis');
        $this->createClient($user31, $manager7, $home7);

        $user32 = $this->createUser('aharrison@gmail.com', 'Adam', 'Harrison');
        $this->createClient($user32, $manager7, $home7);

        $user33 = $this->createUser('emcdonald@gmail.com', 'Eleanor', 'McDonald');
        $this->createClient($user33, $manager7, $home7);

        $user34 = $this->createUser('wbennett@gmail.com', 'William', 'Bennett');
        $this->createClient($user34, $manager7, $home7);

        $user35 = $this->createUser('iwood@gmail.com', 'Isla', 'Wood');
        $this->createClient($user35, $manager7, $home7);

    }

    private function createUser(string $email, string $firstName, string $surname): User {
        $user = User::firstOrCreate([
            'email' => $email,
        ], [
            'first_name' => $firstName,
            'surname' => $surname,
            'password' => env('CLIENT_PASSWORD'),
        ]);

        $user->email_verified_at = now();
        $user->save();
        return $user;
    }

    private function createClient(User $user, Manager $manager, Home $home): Client {

        $client = Client::firstOrCreate([
            'user_id' => $user->id,
            'home_id' => $home->id,
        ]);

        $client->home_id = $home->id;
        $client->is_verified = true;
        $client->verified_at = now();
        $client->verified_by_user_id = $manager->user_id;
        $client->client_status = ClientStatus::Active;
        $client->client_status_updated_at = now();
        $client->client_status_updated_by_user_id = $manager->user_id;
        $client->save();
        return $client;

    }
}
