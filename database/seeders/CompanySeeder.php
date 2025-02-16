<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if ( Organization::all()->count() > 5 ) { // prevent run if Organization is not seeded before
            $this->call( OrganizationSeeder::class );
        }

        Company::factory(30)->create([
            'organization_id' => Organization::inRandomOrder()->first()->id,
        ]);

        $client_users = User::where('user_type', 'CLIENT')->get();

        foreach ($client_users as $user) {
            $organization = Company::inRandomOrder()->first();
            $user->companies()->attach($organization->id);
        }
    }
}
