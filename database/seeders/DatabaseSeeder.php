<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\AppUssdMenu;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Organization::factory()
                ->has(
                    App::factory()
                        ->has(
                            AppUssdMenu::factory()
                        )
                    )
                    ->create();
    }
}
