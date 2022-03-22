<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::factory()->create();

        App::create([
            'name' => 'gmea_ussd',
            'organization_id' => 2,
            'status' => 1,
        ]);
    }
}
