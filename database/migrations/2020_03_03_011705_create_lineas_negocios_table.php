<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineasNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas_negocios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('abreviatura',5);
            //Adicionales
            $table->text('comentario', '500')->nullable();
            $table->string('adicional1')->nullable();
            $table->string('adicional2')->nullable();
            $table->string('adicional3')->nullable();
            $table->string('adicional4')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineas_negocios');
    }
}
