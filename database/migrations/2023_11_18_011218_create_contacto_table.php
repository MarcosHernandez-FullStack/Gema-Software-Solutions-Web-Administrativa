<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('email');
            $table->string('telefono',20)->nullable();
            $table->string('asunto')->nullable();
            $table->text('mensaje')->nullable();
            $table->enum('estado', [0, 1])->default(1); // '0' Archivado, '1' Nuevo, '2' Atendido
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
        Schema::dropIfExists('contacto');
    }
}
