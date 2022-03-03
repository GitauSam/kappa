<?php

namespace Database\Seeders;

use App\Models\UssdMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // UssdMenu::factory(5)->create();
        
        $welcomeMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_welcome_menu',
            'next_menu_key' => 'kappa_username_menu',
            'menu_text' => 'Welcome to kappa ussd. Please select one to continue:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);
        
        $usernameMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_username_menu',
            'next_menu_key' => 'kappa_email_menu',
            'previous_menu_key' => $welcomeMenu->menu_key,
            'menu_text' => 'Please enter your full name.',
            'menu_action' => 'appendSessionData',
            'menu_session_field' => 'user_full_name',
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $emailMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_email_menu',
            'next_menu_key' => 'kappa_idtype_menu',
            'previous_menu_key' => $usernameMenu->menu_key,
            'menu_text' => 'Please enter your email.',
            'menu_action' => 'appendSessionData',
            'menu_session_field' => 'user_email',
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);
        
        $idTypeMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_idtype_menu',
            'next_menu_key' => 'kappa_idnumber_menu',
            'previous_menu_key' => $emailMenu->menu_key,
            'menu_text' => 'Enter ID type:',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $idnumberMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_idnumber_menu',
            'next_menu_key' => 'kappa_thankyou_menu',
            'previous_menu_key' => $emailMenu->menu_key,
            'menu_text' => 'Please enter your ID number.',
            'menu_action' => 'appendSessionData',
            'menu_session_field' => 'user_identification_number',
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);
        
        $thankyouMenu = UssdMenu::create([
            'app_ussd_menu' => 1,
            'menu_key' => 'kappa_thankyou_menu',
            'previous_menu_key' => $idnumberMenu->menu_key,
            'menu_text' => 'Thank you. Your request is being processed.',
            'is_final_menu' => 1,
            'status' => 1,
        ]);
    }
}
