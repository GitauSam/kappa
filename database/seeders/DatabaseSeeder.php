<?php

namespace Database\Seeders;

use Database\Seeders\Gmea\GmeaUssdMenuOptionSeeder;
use Database\Seeders\Gmea\GmeaUssdMenuSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OrganizationSeeder::class,
            AppSeeder::class,
            AppUssdMenuSeeder::class,
            UssdMenuSeeder::class,
            UssdMenuOptionSeeder::class,
            GmeaUssdMenuSeeder::class,
            GmeaUssdMenuOptionSeeder::class,
        ]);
    }
}
