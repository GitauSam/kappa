<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UssdMenu>
 */
class UssdMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'app_ussd_menu' => 1,
            'menu_key' => $this->faker->sentence(2),
            'next_menu_key' => $this->faker->sentence(2),
            'previous_menu_key' => $this->faker->sentence(2),
            'menu_text' => $this->faker->sentence(5),
            'menu_action' => null,
            'is_final_menu' => 0,
            'status' => 1,
        ];
    }
}
