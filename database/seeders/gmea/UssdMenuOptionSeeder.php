<?php

namespace Database\Seeders\Gmea;

use App\Models\UssdMenuOption;
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
        $welcomeMenuGmeaVehicleSalesOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_vehicle_sales_option',
            'option_menu_text' => 'Vehicle Sales',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaVehicleServiceOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_vehicle_service_option',
            'option_menu_text' => 'Vehicle Service',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaMaxitLoyaltyOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_maxit_loyalty_option',
            'option_menu_text' => 'MAXIT Loyalty',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaPartsOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_parts_option',
            'option_menu_text' => 'Parts',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaTechnicalAssistanceOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_technical_assistance_option',
            'option_menu_text' => 'Technical Assistance',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaContactsOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_contacts_option',
            'option_menu_text' => 'Contacts',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaLocateDealerOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_locate_dealer_option',
            'option_menu_text' => 'Locate Dealer',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaBrochureOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_brochure_option',
            'option_menu_text' => 'Brochures',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaOffersOption = UssdMenuOption::create([
            'ussd_menu_id' => 1,
            'option_menu_key' => 'welcome_menu_offers_option',
            'option_menu_text' => 'Offers',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
    }
}
