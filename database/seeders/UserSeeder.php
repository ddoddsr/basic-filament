<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure admin exists
        User::firstOrCreate(
            ['email' => 'admin@ex.io'],
            [
                'name'      => 'Admin User',
                'password'  => bcrypt('asdf'),
                'user_type' => UserTypeEnum::ADMIN,
            ]
        );

        // Create 20 Staff users if they don't already exist
        if (User::where('user_type', UserTypeEnum::STAFF)->count() < 20) {
            User::factory(20)->staff()->create();
        }

        // Create 200 Client users if they don't already exist
        if (User::where('user_type', UserTypeEnum::CLIENT)->count() < 200) {
            User::factory(200)->client()->create();
        }
    }
}
