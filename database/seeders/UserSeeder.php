<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@ex.io'
            ],[
                'name' => 'Test User',
                'password' => bcrypt('asdf'),
                'user_type' => 'ADMIN',
            ]
        );

        if ( User::where('user_type', 'STAFF' )->count() < 20) {
            User::factory(20)->staff()->create();
        }

        if ( User::where('user_type', 'CLIENT' )->count() < 200) {
            User::factory(200)->client()->create();
        }
    }
}
