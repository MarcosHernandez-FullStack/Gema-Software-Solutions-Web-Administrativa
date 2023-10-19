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
                //DISEÑO WEB
                [
                    'nombre' => 'DISEÑO WEB PARA GESTIONAR PAGOS',
                    'fecha_implementacion' => '2022-03-05',
                    'ruta_foto' => 'public/proyectos/DISEÑO WEB PARA GESTIONAR PAGOS — Luis.jpg',
                    'servicio_id'=>1,
                    'empresa_id'=>1
                ],
                [
                    'nombre' => 'DISEÑO WEB PARA PAGOS DE MATRICULAS',
                    'fecha_implementacion' => '2022-02-06',
                    'ruta_foto' => 'public/proyectos/DISEÑO WEB PARA PAGOS DE MATRÍCULAS — Arturo.jpg',
                    'servicio_id'=>1,
                    'empresa_id'=>2
                ],

                //SISTEMAS DE INFORMACIÓN
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

                //ECOMMERCE
                [
                    'nombre' => 'ECOMMERCE PARA GESTIONAR PAGOS',
                    'fecha_implementacion' => '2022-07-08',
                    'ruta_foto' => 'public/proyectos/ECOMMERCE PARA GESTIONAR PAGOS — Luis.jpg',
                    'servicio_id'=>3,
                    'empresa_id'=>1
                ],
                [
                    'nombre' => 'ECOMMERCE PARA PAGOS DE MATRICULAS',
                    'fecha_implementacion' => '2022-09-02',
                    'ruta_foto' => 'public/proyectos/ECOMMERCE PARA PAGOS DE MATRÍCULAS — Arturo.jpg',
                    'servicio_id'=>3,
                    'empresa_id'=>2
                ],
                
            ]);
    }
}
