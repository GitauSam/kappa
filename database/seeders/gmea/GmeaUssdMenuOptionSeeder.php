<?php

namespace Database\Seeders\Gmea;

use App\Models\UssdMenuOption;
use Illuminate\Database\Seeder;

class GmeaUssdMenuOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $welcomeMenuGmeaVehicleSalesOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_vehicle_sales_option',
            'option_menu_text' => 'Vehicle Sales',
            'option_menu_next_menu_key' => 'gmea_vehicle_sales_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaVehicleServiceOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_vehicle_service_option',
            'option_menu_text' => 'Vehicle Service',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaMaxitLoyaltyOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_maxit_loyalty_option',
            'option_menu_text' => 'MAXIT Loyalty',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaPartsOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_parts_option',
            'option_menu_text' => 'Parts',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaTechnicalAssistanceOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_technical_assistance_option',
            'option_menu_text' => 'Technical Assistance',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaContactsOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_contacts_option',
            'option_menu_text' => 'Contacts',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaLocateDealerOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_locate_dealer_option',
            'option_menu_text' => 'Locate Dealer',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaBrochureOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_brochure_option',
            'option_menu_text' => 'Brochures',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $welcomeMenuGmeaOffersOption = UssdMenuOption::create([
            'ussd_menu_id' => 8,
            'option_menu_key' => 'welcome_menu_offers_option',
            'option_menu_text' => 'Offers',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleSalesVehiclePricesOption = UssdMenuOption::create([
            'ussd_menu_id' => 9,
            'option_menu_key' => 'vehicle_sales_vehicle_prices_option',
            'option_menu_text' => 'Vehicle Prices',
            'option_menu_next_menu_key' => 'gmea_vehicle_make_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleSalesRequestQuoteOption = UssdMenuOption::create([
            'ussd_menu_id' => 9,
            'option_menu_key' => 'vehicle_sales_request_quote_option',
            'option_menu_text' => 'Request a Quote',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleSalesBookTestDriveOption = UssdMenuOption::create([
            'ussd_menu_id' => 9,
            'option_menu_key' => 'vehicle_sales_book_test_drive_option',
            'option_menu_text' => 'Book a Test Drive',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleSalesBackOption = UssdMenuOption::create([
            'ussd_menu_id' => 9,
            'option_menu_key' => 'vehicle_sales_back_option',
            'option_menu_text' => 'Back',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeIsuzuMuxOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_mux_option',
            'option_menu_text' => 'Isuzu mu-X',
            'option_menu_next_menu_key' => 'gmea_vehicle_make_isuzu_mux_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeIsuzuPickUpsOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_pickups_option',
            'option_menu_text' => 'Isuzu Pickups',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeIsuzu4To8TonnesOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_4_8_tonnes_option',
            'option_menu_text' => 'Isuzu 4.1 - 8.5 Tonne Truck',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeIsuzuBusesOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_buses_option',
            'option_menu_text' => 'Isuzu Buses',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $vehiclePricesMakeIsuzu11To26TonnesOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_11_26_tonnes_option',
            'option_menu_text' => 'Isuzu 11 - 26 Tonne Truck',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeIsuzuPrimeMoverOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_isuzu_prime_mover_option',
            'option_menu_text' => 'Isuzu Prime Mover',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeBackOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_back_option',
            'option_menu_text' => 'Back',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehiclePricesMakeBackOption = UssdMenuOption::create([
            'ussd_menu_id' => 10,
            'option_menu_key' => 'vehicle_make_main_menu_option',
            'option_menu_text' => 'Main Menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $vehicleMakeIsuzuMux25LOption = UssdMenuOption::create([
            'ussd_menu_id' => 11,
            'option_menu_key' => 'vehicle_make_isuzu_mux_25L_option',
            'option_menu_text' => 'mu-X 2.5L',
            'option_menu_next_menu_key' => 'gmea_vehicle_make_retail_price_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $vehicleMakeIsuzuMux25LOption = UssdMenuOption::create([
            'ussd_menu_id' => 11,
            'option_menu_key' => 'vehicle_make_isuzu_mux_3L_option',
            'option_menu_text' => 'mu-X 3L',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeIsuzuMux25LOption = UssdMenuOption::create([
            'ussd_menu_id' => 11,
            'option_menu_key' => 'vehicle_make_isuzu_back_option',
            'option_menu_text' => 'Back',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRetailPriceQuoteOption = UssdMenuOption::create([
            'ussd_menu_id' => 12,
            'option_menu_key' => 'vehicle_make_retail_price_quote_option',
            'option_menu_text' => 'Request for a quote',
            'option_menu_next_menu_key' => 'gmea_vehicle_make_request_quote_fullname_menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
        
        $vehicleMakeRetailPriceBackOption = UssdMenuOption::create([
            'ussd_menu_id' => 12,
            'option_menu_key' => 'vehicle_make_retail_price_back_option',
            'option_menu_text' => 'Back',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);

        $vehicleMakeRetailPriceMainMenuOption = UssdMenuOption::create([
            'ussd_menu_id' => 12,
            'option_menu_key' => 'vehicle_make_retail_price_main_menu_option',
            'option_menu_text' => 'Main Menu',
            'is_menu_option_interactive' => 1,
            'status' => 1,
        ]);
    }
}
