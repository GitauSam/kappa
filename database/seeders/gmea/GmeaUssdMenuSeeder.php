<?php

namespace Database\Seeders\Gmea;

use App\Models\UssdMenu;
use Illuminate\Database\Seeder;

class GmeaUssdMenuSeeder extends Seeder
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

        $vehicleSalesMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_sales_menu',
            'menu_text' => 'CON Welcome to the Isuzu vehicle sales portal:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_menu',
            'menu_text' => 'CON Choose a Vehicle Make:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_isuzu_mux_menu',
            'menu_text' => 'CON Choose an Isuzu mu-X Model:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRetailPriceMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_retail_price_menu',
            'menu_text' => 'CON The retail price of an Isuzu mu-X is Kes 6,917,000.00:',
            'menu_action' => 'serveMenu',
            'is_parent' => 1,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRequestQuoteFullNameMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_request_quote_fullname_menu',
            'menu_text' => "CON Enter your full name:\n",
            'menu_action' => 'serveMenu',
            'next_menu_key' => 'gmea_vehicle_make_request_quote_email_menu',
            'is_parent' => 0,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRequestQuoteEmailMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_request_quote_email_menu',
            'menu_text' => "CON Enter your email address:\n",
            'menu_action' => 'serveMenu',
            'next_menu_key' => 'gmea_vehicle_make_request_quote_end_menu',
            'is_parent' => 0,
            'is_final_menu' => 0,
            'is_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRequestQuoteEndMenu = UssdMenu::create([
            'app_ussd_menu' => 2,
            'menu_key' => 'gmea_vehicle_make_request_quote_end_menu',
            'menu_text' => "END Dear full name,\nYour make model quote request has been confirmed, we will get back to you via the email provided. Thank you.\n",
            'menu_action' => 'serveMenu',
            'is_parent' => 0,
            'is_final_menu' => 1,
            'is_interactive' => 1,
            'status' => 1,
        ]);
    }
}
