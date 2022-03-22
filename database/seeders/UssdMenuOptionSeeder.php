<?php

namespace Database\Seeders;

use App\Models\UssdMenuOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UssdMenuOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $welcomeMenuContinueOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_continue_option',
            'option_menu_text' => 'Continue',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $welcomeMenuExitOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_exit_option',
            'option_menu_text' => 'Exit',
            'option_menu_action' => 'exitMenu',
            'option_menu_next_menu_key' => 'kappa_exit_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $idTypeMenuNationalIdOption = UssdMenuOption::create([
            'ussd_menu_id' => 4,
            'option_menu_key' => 'id_type_menu_national_id_option',
            'option_menu_text' => 'National ID',
            'option_menu_action' => 'appendSessionData',
            'option_menu_session_field' => 'user_identification_type',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $idTypeMenuAlienIdOption = UssdMenuOption::create([
            'ussd_menu_id' => 4,
            'option_menu_key' => 'id_type_menu_alien_id_option',
            'option_menu_text' => 'Alien ID',
            'option_menu_action' => 'appendSessionData',
            'option_menu_session_field' => 'user_identification_type',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $idTypeMenuPassportOption = UssdMenuOption::create([
            'ussd_menu_id' => 4,
            'option_menu_key' => 'id_type_menu_passport_option',
            'option_menu_text' => 'Passport',
            'option_menu_action' => 'appendSessionData',
            'option_menu_session_field' => 'user_identification_type',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $idTypeMenuServiceCardOption = UssdMenuOption::create([
            'ussd_menu_id' => 4,
            'option_menu_key' => 'id_type_menu_service_card_option',
            'option_menu_text' => 'Service Card',
            'option_menu_action' => 'appendSessionData',
            'option_menu_session_field' => 'user_identification_type',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
    }
}
