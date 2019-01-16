<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('fecha_prestamo');
            $table->date('fecha_entrega');
            $table->enum('estado',['P','E']);
            $table->unsignedInteger('estudiante_id');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('libro_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamo');
    }
}
