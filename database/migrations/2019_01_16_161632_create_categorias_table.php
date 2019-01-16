<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_bloque','50');
            $table->integer('fila');
        });

        DB::table('categoria')->insert([
            'nombre_bloque'=>'Libro',
        ]);
        DB::table('categoria')->insert([
            'nombre_bloque'=>'Revista',
        ]);
        DB::table('categoria')->insert([
            'nombre_bloque'=>'Catálogo',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria');
    }
}
