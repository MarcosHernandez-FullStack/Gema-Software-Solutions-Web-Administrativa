<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficioServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficio_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficio_id')->constrained('beneficio');
            $table->foreignId('servicio_id')->constrained('servicio');
            $table->enum('estado', [0, 1])->default(1);
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
        Schema::dropIfExists('beneficio_servicio');
    }
}
