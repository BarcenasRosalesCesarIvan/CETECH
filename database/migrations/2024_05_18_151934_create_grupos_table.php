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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodo_id');
            $table->unsignedBigInteger('planEstudio_id');
            $table->unsignedBigInteger('materia_id');            
            $table->integer('semestre');
            $table->string('letra_grupo');
            $table->string('capacidad');
            $table->unsignedBigInteger('docente_id');            
        

            // Definicion de foraneas

            $table->foreign('periodo_id')
                ->references('id')->on('periodos');

            $table->foreign('planEstudio_id')
                ->references('id')->on('planes_estudio');

            $table->foreign('materia_id')
                ->references('id')->on('materias');
                
            $table->foreign('docente_id')
                ->references('id')->on('docentes');

            $table->timestamps(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
};
