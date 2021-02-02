<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMujeres extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mujeres', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('especialidad');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('nacimiento')->nullable();
            $table->string('fallecido')->nullable();
            $table->string('nacionalidad');
            $table->foreign('especialidad')->references('id')->on('especialidades');
            $table->string('foto')->nullable();
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('mujeres');
    }
}
