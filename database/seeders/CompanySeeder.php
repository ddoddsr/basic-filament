<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = Organization::all();

        // Ensure that we have organizations before seeding companies
        if ($organizations->isEmpty()) {
            $this->call(OrganizationSeeder::class);
            $organizations = Organization::all();
        }

        $companies = Company::factory(30)->create([
            'organization_id' => $organizations->random()->id,
        ]);

        $clients = User::where('user_type', 'client')->get();

        // Attach 10 random clients to each company
        foreach ($companies as $company) {
            $company->clients()->attach($clients->random(10));
        }
    }
}
