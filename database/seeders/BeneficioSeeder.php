<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beneficio;

class BeneficioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beneficio::insert(
            [
                [
                    'descripcion' => 'Presencia en línea',
                ],
                [
                    'descripcion' => 'Credibilidad y profesionalismo',
                ],
                [
                    'descripcion' => 'Ahorro de costos',
                ],
                [
                    'descripcion' => 'Almacenamiento de contenido',
                ],
                [
                    'descripcion' => 'Interacción con los usuarios',
                ],
            ]);
    }
}
