<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_id');
            $table->bigInteger('empresas_id')->default(0);
            $table->bigInteger('escuelas_id')->default(0);
            $table->tinyInteger('conv_promo')->default(0);
            $table->text('descripcion_conv_promo',500)->nullable();
            $table->tinyInteger('conv_servicio')->default(0);
            $table->text('descripcion_conv_servicio',500)->nullable();
            $table->tinyInteger('conv_estadia')->default(0);
            $table->text('descripcion_conv_estadia',500)->nullable();
            $table->timestamp('fecha_conv')->nullable();
            $table->timestamp('vigencia_conv')->nullable();
            $table->string('nombre_representante');
            $table->string('cargo_representante');
            $table->string('correo_representante');
            $table->string('telefono_representante', 30);
            $table->string('user_edit')->nullable();
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
        Schema::dropIfExists('convenios');
    }
}
