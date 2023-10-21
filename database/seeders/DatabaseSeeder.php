<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(UsuarioSeeder::class);
        $this->call(BeneficioSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(ProyectoSeeder::class);
        $this->call(DetalleProyectoSeeder::class);
        $this->call(BeneficioServicioSeeder::class);
    }
}
