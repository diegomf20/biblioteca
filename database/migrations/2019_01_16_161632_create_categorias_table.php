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
            $table->string('nombre_categoria','50');
        });

        DB::table('categoria')->insert([
            'nombre_categoria'=>'Libro',
        ]);
        DB::table('categoria')->insert([
            'nombre_categoria'=>'Revista',
        ]);
        DB::table('categoria')->insert([
            'nombre_categoria'=>'Catálogo',
        ]);
        DB::table('categoria')->insert([
            'nombre_categoria'=>'Articulo',
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
