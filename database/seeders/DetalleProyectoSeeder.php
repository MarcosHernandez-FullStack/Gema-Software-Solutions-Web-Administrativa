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
                [
                    'nombre' => 'ESTADISTICAS FINANCIERAS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA GESTIONAR PAGOS — Luis - 1.jpg',
                    'proyecto_id'=>1,
                ],
                [
                    'nombre' => 'DETALLES DE PAGOS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA GESTIONAR PAGOS — Luis - 2.jpg',
                    'proyecto_id'=>1,
                ],
                [
                    'nombre' => 'HISTORIAL DE PAGOS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA GESTIONAR PAGOS — Luis - 3.jpg',
                    'proyecto_id'=>1,
                ],

                [
                    'nombre' => 'ESTADISTICAS DE MONTOS POR COBRAR Y COBRADOS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA PAGOS DE MATRÍCULAS — Arturo - 1.jpg',
                    'proyecto_id'=>2,
                ],
                [
                    'nombre' => 'REPORTE DE NOTAS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA PAGOS DE MATRÍCULAS — Arturo - 2.jpg',
                    'proyecto_id'=>2,
                ],
                [
                    'nombre' => 'ADMINISTRADOR DE USUARIOS',
                    'ruta_foto' => 'public/detalles-proyectos/SISTEMA PARA PAGOS DE MATRÍCULAS — Arturo - 3.jpg',
                    'proyecto_id'=>2,
                ],
               
                
            ]);
    }
}
