<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_servicio', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->unique();
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->string('ruta_foto')->nullable();
            $table->foreignId('servicio_id')->constrained('servicio');
            $table->date('fecha_implementacion')->nullable();
            $table->string('empresa_cliente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_servicio');
    }
}
