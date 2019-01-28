<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre','150');
            $table->string('apellido','150');
            $table->string('telefono','9');
            $table->date('fecha_vence');
        });
        // Full Text Index
        // DB::statement('ALTER TABLE estudiante ADD FULLTEXT fulltext_index (nombre, apellido)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiante');
    }
}
