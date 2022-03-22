<?php

namespace Database\Seeders\Gmea;

use App\Models\UssdMenu;
use Illuminate\Database\Seeder;

class UssdMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $welcomeMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_welcome_menu',
            'menu_text' => 'CON Welcome to Isuzu EA:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);
    }
}
