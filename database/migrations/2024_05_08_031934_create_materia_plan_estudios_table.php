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
        Schema::create('materia_plan_estudios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('plan_estudio_id');

            $table->foreign('materia_id')
            ->references('id')->on('materias');

            
            $table->foreign('plan_estudio_id')
            ->references('id')->on('planes_estudio');

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
        Schema::dropIfExists('materia_plan_estudios');
    }
};
