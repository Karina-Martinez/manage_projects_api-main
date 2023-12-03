<?php

namespace Database\Seeders;

use App\Models\TareaEstatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TareaEstatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TareaEstatus::create([
            'nombre' => 'En planeación'
        ]);

        TareaEstatus::create([
            'nombre' => 'En proceso'
        ]);

        TareaEstatus::create([
            'nombre' => 'Finalizada'
        ]);
    }
}
