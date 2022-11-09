<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\dishtype;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dishtype>
 */
class DishtypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            dishtype::factory()->create();
        
    }
}
