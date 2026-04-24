<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specie::create([
            'name' => 'Bovinos'
        ]);

        Specie::create([
            'name' => 'Suínos'
        ]);

        Specie::create([
            'name' => 'Caprinos'
        ]);
    }
}
