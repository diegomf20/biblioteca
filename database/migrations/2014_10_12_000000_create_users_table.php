<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedInteger('rol_id');
        });
        DB::table('user')->insert([
            'name'=>'Javier Villalobos',
            'email'=>'acropolis',
            'password'=> bcrypt('acropolis123'),
            'rol_id'=>1,
        ]);

        DB::table('user')->insert([
            'name'=>'Biblioteca',
            'email'=>'biblioteca',
            'password'=> bcrypt('123456'),
            'rol_id'=>2,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
