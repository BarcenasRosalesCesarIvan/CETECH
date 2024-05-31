<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_de_control');
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('curp');
            $table->unsignedBigInteger('plan_estudio_id');
            $table->integer('semestre');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('tipo_de_alumno_id');
            $table->unsignedBigInteger('user_id');

            

            $table->foreign('plan_estudio_id')
                ->references('id')->on('planes_estudio');

            $table->foreign('estatus_id')
                ->references('id')->on('estatus');
                
            $table->foreign('tipo_de_alumno_id')
                ->references('id')->on('tipos_alumnos');

            $table->foreign('user_id')
                ->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
};
