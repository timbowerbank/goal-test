<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\FamilyFriend;
use App\Models\Manager;
use App\Models\User;
use App\Enums\FamilyFriendStatus;


class FamilyFriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // *** manager Didbury House
        $manager1 = Manager::whereHas('user', function($query) {
            $query->where('email', 'jjones@achieve-more.co.uk');
        })->first();

        // manager Purleigh House
        $manager2 = Manager::whereHas('user', function($query) {
            $query->where('email', 'pwilliams@achieve-more.co.uk');
        })->first();

        // manager Konnect House
        $manager3 = Manager::whereHas('user', function($query) {
            $query->where('email', 'dtaylor@achieve-more.co.uk');
        })->first();

        // manager Bickford House
        $manager4 = Manager::whereHas('user', function($query) {
            $query->where('email', 'mthomas@achieve-more.co.uk');
        })->first();

        // manager - Wakefield House
        $manager5 = Manager::whereHas('user', function($query) {
            $query->where('email', 'rwhite@happy-to-help.co.uk');
        })->first();

        // manager - Prescott House
        $manager6 = Manager::whereHas('user', function($query) {
            $query->where('email', 'amartin@happy-to-help.co.uk');
        })->first();

        // manager - Gaskell House
        $manager7 = Manager::whereHas('user', function($query) {
            $query->where('email', 'nrobinson@happy-to-help.co.uk');
        })->first();
     
        // clients
        // *** Didbury House client ***
        $client1 = Client::whereHas('user', function($query){
            $query->where('email', 'jjones@gmail.com');
        })->first();

        // *** Purleigh House client ***
        $client2 = Client::whereHas('user', function($query){
            $query->where('email', 'rwhite@gmail.com');
        })->first();

        // *** Konnect House client ***
        $client3 = Client::whereHas('user', function($query){
            $query->where('email', 'nclark@gmail.com');
        })->first();

        // *** Bickford House client ***
        $client4 = Client::whereHas('user', function($query){
            $query->where('email', 'badams@gmail.com');
        })->first();

        // *** Wakefield House client ***
        $client5 = Client::whereHas('user', function($query){
            $query->where('email', 'aphillips@gmail.com');
        })->first();

        // *** Prescott House client ***
        $client6 = Client::whereHas('user', function($query){
            $query->where('email', 'dcooper@gmail.com');
        })->first();

        // *** Gaskell House client ***
        $client7 = Client::whereHas('user', function($query){
            $query->where('email', 'chellis@gmail.com');
        })->first();

        // create family friends
        // *** Didbury House ***
        $user1 = $this->createUser('malbright@gmail.com', 'Margaret', 'Albright');
        $ff1 = $this->createFamilyFriend($user1, $manager1);
        $this->attachFamilyFriendToClient($ff1, $client1, $manager1);

        // *** Purleigh House ***
        $user2 = $this->createUser('twhite@gmail.com', 'Thomas', 'White');
        $ff2 = $this->createFamilyFriend($user2, $manager2);
        $this->attachFamilyFriendToClient($ff2, $client2, $manager2);

        // *** Konnect House ***
        $user3 = $this->createUser('sclark@gmail.com', 'Susan', 'Clark');
        $ff3 = $this->createFamilyFriend($user3, $manager3);
        $this->attachFamilyFriendToClient($ff3, $client3, $manager3);

        // *** Bickford House ***
        $user4 = $this->createUser('radams@gmail.com', 'Robert', 'Adams');
        $ff4 = $this->createFamilyFriend($user4, $manager4);
        $this->attachFamilyFriendToClient($ff4, $client4, $manager4);

        // *** Wakefield House ***
        $user5 = $this->createUser('bphillips@gmail.com', 'Barbara', 'Phillips');
        $ff5 = $this->createFamilyFriend($user5, $manager5);
        $this->attachFamilyFriendToClient($ff5, $client5, $manager5);

        // *** Prescott House ***
        $user6 = $this->createUser('jcooper@gmail.com', 'Janet', 'Cooper');
        $ff6 = $this->createFamilyFriend($user6, $manager6);
        $this->attachFamilyFriendToClient($ff6, $client6, $manager6);

        // *** Gaskell House ***
        $user7 = $this->createUser('wellis@gmail.com', 'William', 'Ellis');
        $ff7 = $this->createFamilyFriend($user7, $manager7);
        $this->attachFamilyFriendToClient($ff7, $client7, $manager7);

    }

    private function createUser(string $email, string $firstName, string $surname){
        $user = User::firstOrCreate(
            [
                'email' => $email
            ],
            [
                'first_name' => $firstName,
                'surname' => $surname,
                'password' => env('FAMILY_FRIEND_PASSWORD'),
            ]);
        
        $user->email_verified_at = now();
        $user->save();
        return $user;
    }

    private function createFamilyFriend(User $user, Manager $manager):FamilyFriend {
        $family_friend = FamilyFriend::firstOrCreate(
            [
                'user_id' => $user->id,
            ]);
        
        $family_friend->user_id = $user->id;
        $family_friend->is_verified = true;
        $family_friend->verified_at = now();
        $family_friend->verified_by_user_id = $manager->user_id;
        $family_friend->family_friend_status = FamilyFriendStatus::Active;
        $family_friend->family_friend_status_updated_at = now();
        $family_friend->family_friend_status_updated_by_user_id = $manager->user_id;
        $family_friend->save();

        return $family_friend;
        
    }

    private function attachFamilyFriendToClient(FamilyFriend $family_friend, Client $client, Manager $manager) {
        $client->familyFriends()->syncWithoutDetaching([
            $family_friend->id => [
                'started_at' => now(),
                'created_by_user_id' => $manager->user_id,
            ]
        ]);
    }
}
