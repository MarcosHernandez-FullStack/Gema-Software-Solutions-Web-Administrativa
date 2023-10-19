<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;
class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proyecto::insert(
            [
                [
                    'nombre' => 'SISTEMA PARA GESTIONAR PAGOS',
                    'fecha_implementacion' => '2022-10-11',
                    'ruta_foto' => 'public/proyectos/SISTEMA PARA GESTIONAR PAGOS — Luis.jpg',
                    'servicio_id'=>2,
                    'empresa_id'=>1
                ],
                [
                    'nombre' => 'SISTEMA PARA PAGOS DE MATRICULAS',
                    'fecha_implementacion' => '2022-08-07',
                    'ruta_foto' => 'public/proyectos/SISTEMA PARA PAGOS DE MATRÍCULAS — Arturo.jpg',
                    'servicio_id'=>2,
                    'empresa_id'=>2
                ],
                
            ]);
    }
}
