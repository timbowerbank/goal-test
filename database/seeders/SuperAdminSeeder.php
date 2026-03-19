<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SuperAdmin;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a user
        $user = User::create([
            'first_name' => 'Tim',
            'surname' => 'Bowerbank',
            'email' => 'tim@pendigital.co.uk',
            'email_verified_at' => now(),
            'password' => env('SUPER_ADMIN_PASSWORD'),
        ]);

        // Now let's create a SuperAdmin instance
        SuperAdmin::create([
            'user_id' => $user->id,

        ]);
    }
}
