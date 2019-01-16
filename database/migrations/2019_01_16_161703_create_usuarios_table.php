<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre','150');
            $table->string('apellido','150');
            $table->string('usuario','50');
            $table->string('contrasenia','50');
            $table->string('email','150');
        });
        DB::table('usuario')->insert([
            'nombre'=>'Diego',
            'apellido'=>'Perez',
            'usuario'=>'11',
            'contrasenia'=>'11',
            'email'=>'a@a.c'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
