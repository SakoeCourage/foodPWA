<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\dishtype;

class dishtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = collect([
            'Biscuit', 'Braai', 'Bread,Rolls and Muffins', 'Cakes', 'Curries', 'Desserts', 'Pasta', 'Pizza', 'Quiche', 'Roast', 'Salad', 'Sandwich', 'Savoury Pies, Pastries & Tarts', 'Snacks', 'Soup', 'Stews', 'Sweet Pies, Pastries & Tarts', 'Vension','others'
        ]);
        $dishes->each(function ($dish, $key) {
            dishtype::insert([
                'dishtype' => $dish,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });
    }
}
