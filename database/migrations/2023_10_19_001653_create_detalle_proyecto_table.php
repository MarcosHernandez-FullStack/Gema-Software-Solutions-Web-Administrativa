<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_proyecto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado', [0, 1])->default(1);
            $table->string('ruta_foto');
            $table->foreignId('proyecto_id')->constrained('proyecto');
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
        Schema::dropIfExists('detalle_proyecto');
    }
}
