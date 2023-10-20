<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('estado', [0, 1])->default(1);
            $table->string('ruta_foto_principal');
            $table->string('ruta_foto_secundaria');
            $table->string('descripcion_resumida');
            $table->text('descripcion_amplia');
           /*  $table->foreignId('users_id')->constrained('users')->nullable(); */
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
        Schema::dropIfExists('servicio');
    }
}
