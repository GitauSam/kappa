<?php

namespace Database\Seeders;

use App\Models\AppUssdMenu;
use Illuminate\Database\Seeder;

class AppUssdMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUssdMenu::factory()->create();

        AppUssdMenu::create(
            [
                'ussd_code' => '*824#',
                'app_id' => 2,
                'root_menu_key' => 'gmea_welcome_menu',
                'status' => 1,
            ]
        );
    }
}
