<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = User::create([
            'name' => 'Departamento de Escolares',
            'email' => 'escolares@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
      ]);

      $user = User::create([
        'name' => 'Departamento de Division de Estudios',
        'email' => 'division@sjuanrio.tecnm.mx',
        'password' => Hash::make('12345678'),
  ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
