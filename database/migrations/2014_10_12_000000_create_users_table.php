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
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('usu_id');
            $table->string('usu_ci')->nullable()->unique();
            $table->string('usu_expedido')->nullable();
            $table->string('usu_nombre');
            $table->string('usu_email')->unique();
            $table->string('usu_password');
            $table->string('usu_nick');
            $table->date('usu_fecha_nacimiento');
            $table->string('usu_genero');
            $table->string('usu_pais')->default('BOLIVIA');
            $table->string('usu_telefono');
            $table->string('usu_foto')->nullable();
            $table->boolean('usu_verificado')->default(false);
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
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
