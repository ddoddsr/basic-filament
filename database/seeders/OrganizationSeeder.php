<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::factory(5)->create();

        $staff_users = User::where('user_type', 'STAFF')->get();

        foreach ($staff_users as $user) {
            $organization = Organization::inRandomOrder()->first();
            $user->organizations()->attach($organization->id);
        }

    }


}
