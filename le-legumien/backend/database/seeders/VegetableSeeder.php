<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vegetable;

class VegetableSeeder extends Seeder
{
    public function run(): void
    {
        Vegetable::insert([
            ['title' => 'Carotte', 'description' => 'Carotte fraîche', 'image' => 'carotte.png'],
            ['title' => 'Tomate', 'description' => 'Tomate rouge', 'image' => 'tomate.png'],
            ['title' => 'Chou', 'description' => 'Chou vert', 'image' => 'chou.png'],
        ]);
    }
}
