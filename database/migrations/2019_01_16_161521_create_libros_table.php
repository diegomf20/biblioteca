<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titulo','100');
            $table->string('autor','100');
            $table->integer('fila');
            $table->string('codigo','15');
            $table->string('descripcion');
            $table->string('fechaP')->nullable();;
            $table->unsignedInteger('bloque_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro');
    }
}
