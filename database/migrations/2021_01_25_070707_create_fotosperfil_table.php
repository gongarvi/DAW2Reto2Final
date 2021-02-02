<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosperfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotosperfil', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('mujer');
            $table->foreign('usuario')->references('id')->on('users');
            $table->foreign('mujer')->references('id')->on('mujeres');
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
        Schema::dropIfExists('fotosperfil');
    }
}
