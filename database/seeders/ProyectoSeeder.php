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
                //DISEÑO WEB (1)
                [
                    /* 1 */
                    'nombre' => 'PÁGINA WEB PARA COLEGIO PROFESIONAL',
                    'fecha_implementacion' => '2022-03-05',
                    'ruta_foto' => 'public/proyectos/web-01.png',
                    'servicio_id' => 1,
                    'empresa_id' => 5
                ],



                //SISTEMAS DE INFORMACIÓN (5)
                [
                    /* 2 */
                    'nombre' => 'SISTEMA PARA CONTROL DE PAGOS',
                    'fecha_implementacion' => '2022-10-11',
                    'ruta_foto' => 'public/proyectos/si-01.png',
                    'servicio_id' => 2,
                    'empresa_id' => 5
                ],
                [
                    /* 3 */
                    'nombre' => 'SISTEMA PARA MATRÍCULAS Y NOTAS',
                    'fecha_implementacion' => '2022-08-07',
                    'ruta_foto' => 'public/proyectos/si-02.png',
                    'servicio_id' => 2,
                    'empresa_id' => 6
                ],

                [
                    /* 4 */
                    'nombre' => 'SISTEMA PARA CONTROL DE NOTAS',
                    'fecha_implementacion' => '2022-08-07',
                    'ruta_foto' => 'public/proyectos/si-03.png',
                    'servicio_id' => 2,
                    'empresa_id' => 7
                ],

                [
                    /* 5 */
                    'nombre' => 'SISTEMA PARA TESORERÍA',
                    'fecha_implementacion' => '2022-08-07',
                    'ruta_foto' => 'public/proyectos/si-04.png',
                    'servicio_id' => 2,
                    'empresa_id' => 5
                ],

                [
                    /* 6 */
                    'nombre' => 'SISTEMA PARA VENTA DE PASAJES',
                    'fecha_implementacion' => '2022-08-07',
                    'ruta_foto' => 'public/proyectos/si-05.png',
                    'servicio_id' => 2,
                    'empresa_id' => 5
                ],


                //ECOMMERCE (1)
                [
                    /* 7 */
                    'nombre' => 'VENTA DE PRODUCTOS ELECTRÓNICOS',
                    'fecha_implementacion' => '2022-07-08',
                    'ruta_foto' => 'public/proyectos/ec-01.png',
                    'servicio_id' => 3,
                    'empresa_id' => 1
                ]


            ]
        );
    }
}
