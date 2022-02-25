<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppUssdMenu>
 */
class AppUssdMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ussd_code' => '*655#',
            'app_id' => 1,
            'root_menu_key' => 'kappa_welcome_menu',
            'status' => 1,
        ];
    }
}
