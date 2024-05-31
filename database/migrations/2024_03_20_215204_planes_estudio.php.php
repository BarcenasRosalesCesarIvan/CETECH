<?php

use Illuminate\Console\Scheduling\ScheduleRunCommand;
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
        Schema::create('planes_estudio', function (Blueprint $table) {
            $table->id(); //integer,autoincrement, primary key
            $table->string('clave_plan_estudio',20); //varchar (20)
            $table->string('carrera'); //unique() lo hace unico
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
};
