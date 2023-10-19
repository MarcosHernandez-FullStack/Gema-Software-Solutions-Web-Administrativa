<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Empresa;
class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Empresa::insert(
            [
                [
                    'razon_social' => 'Colegio de abogados de Trujillo',
                    'ruc' => '12345678901',
                    'email' => 'colegioabogados@gmail.com'
                ],
                [
                    'razon_social' => 'Colegio Narvaez de Trujillo',
                    'ruc' => '12345678902',
                    'email' => 'colegionarvaez@gmail.com'
                ],
                
            ]);
    }
}
