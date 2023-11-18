<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleProyecto;

class DetalleProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetalleProyecto::insert(
            [
                /* 1 */
                [
                    'nombre' => 'PÁGINA PRINCIPAL',
                    'ruta_foto' => 'public/detalles-proyectos/web-01-1.png',
                    'proyecto_id' => 1,
                ],
                [
                    'nombre' => 'SECCIÓN DE CONTACTO',
                    'ruta_foto' => 'public/detalles-proyectos/web-01-2.png',
                    'proyecto_id' => 1,
                ],
                [
                    'nombre' => 'PANEL DE ADMINISTRACIÓN',
                    'ruta_foto' => 'public/detalles-proyectos/web-01-3.png',
                    'proyecto_id' => 1,
                ],

                /* 2 */
                [
                    'nombre' => 'ESTADISTICAS DE INGRESOS',
                    'ruta_foto' => 'public/detalles-proyectos/si-01-1.png',
                    'proyecto_id' => 2,
                ],
                [
                    'nombre' => 'DETALLE DE PAGO',
                    'ruta_foto' => 'public/detalles-proyectos/si-01-2.png',
                    'proyecto_id' => 2,
                ],
                [
                    'nombre' => 'HISTORIAL Y REPORTES',
                    'ruta_foto' => 'public/detalles-proyectos/si-01-3.png',
                    'proyecto_id' => 2,
                ],


                /* 3 */
                [
                    'nombre' => 'ESTADISTICAS DE INGRESOS',
                    'ruta_foto' => 'public/detalles-proyectos/si-02-1.png',
                    'proyecto_id' => 3,
                ],
                [
                    'nombre' => 'REPORTE DE NOTAS',
                    'ruta_foto' => 'public/detalles-proyectos/si-02-2.png',
                    'proyecto_id' => 3,
                ],
                [
                    'nombre' => 'GESTIÓN DE USUARIOS',
                    'ruta_foto' => 'public/detalles-proyectos/si-02-3.png',
                    'proyecto_id' => 3,
                ],


                /* 4 */
                [
                    'nombre' => 'GRÁFICA DE PROGESOS',
                    'ruta_foto' => 'public/detalles-proyectos/si-03-1.png',
                    'proyecto_id' => 4,
                ],
                [
                    'nombre' => 'REGISTRO DE NOTAS',
                    'ruta_foto' => 'public/detalles-proyectos/si-03-2.png',
                    'proyecto_id' => 4,
                ],
                [
                    'nombre' => 'REPORTE DE NOTAS',
                    'ruta_foto' => 'public/detalles-proyectos/si-03-3.png',
                    'proyecto_id' => 4,
                ],


                /* 5 */
                [
                    'nombre' => 'REGISTRO DE MATRÍCULA',
                    'ruta_foto' => 'public/detalles-proyectos/si-04-1.png',
                    'proyecto_id' => 5,
                ],
                [
                    'nombre' => 'REGISTRO DE COBRO',
                    'ruta_foto' => 'public/detalles-proyectos/si-04-2.png',
                    'proyecto_id' => 5,
                ],
                [
                    'nombre' => 'REPORTE',
                    'ruta_foto' => 'public/detalles-proyectos/si-04-3.png',
                    'proyecto_id' => 5,
                ],


                /* 6 */
                [
                    'nombre' => 'BOLETOS COMPRADOS',
                    'ruta_foto' => 'public/detalles-proyectos/si-05-1.png',
                    'proyecto_id' => 6,
                ],
                [
                    'nombre' => 'SELECCIÓN DE BUS',
                    'ruta_foto' => 'public/detalles-proyectos/si-05-2.png',
                    'proyecto_id' => 6,
                ],
                [
                    'nombre' => 'VISTA PRINCIPAL',
                    'ruta_foto' => 'public/detalles-proyectos/si-05-3.png',
                    'proyecto_id' => 6,
                ],

                /* 7 */
                [
                    'nombre' => 'PANTALLA PRINCIPAL',
                    'ruta_foto' => 'public/detalles-proyectos/ec-01-1.png',
                    'proyecto_id' => 7,
                ],
                [
                    'nombre' => 'DETALLE DE PRODUCTO',
                    'ruta_foto' => 'public/detalles-proyectos/ec-01-2.png',
                    'proyecto_id' => 7,
                ],
                [
                    'nombre' => 'MANTENEDOR DE PRODUCTOS',
                    'ruta_foto' => 'public/detalles-proyectos/ec-01-3.png',
                    'proyecto_id' => 7,
                ],



            ]
        );
    }
}
