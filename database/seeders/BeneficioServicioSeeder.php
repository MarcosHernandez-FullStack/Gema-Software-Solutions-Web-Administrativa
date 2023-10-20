<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BeneficioServicio;

class BeneficioServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BeneficioServicio::insert(
            [
                [
                    'servicio_id' => 1,
                    'beneficio_id' => 1,
                ],
                [
                    'servicio_id' => 1,
                    'beneficio_id' => 2,
                ],
                [
                    'servicio_id' => 1,
                    'beneficio_id' => 3,
                ],

                [
                    'servicio_id' => 2,
                    'beneficio_id' => 3,
                ],
                [
                    'servicio_id' => 2,
                    'beneficio_id' => 4,
                ],
                [
                    'servicio_id' => 2,
                    'beneficio_id' => 5,
                ],

                [
                    'servicio_id' => 3,
                    'beneficio_id' => 1,
                ],
                [
                    'servicio_id' => 3,
                    'beneficio_id' => 3,
                ],
                [
                    'servicio_id' => 3,
                    'beneficio_id' => 5,
                ],
               
            ]);
    }
}
