<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscritos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_banner',10);
            $table->bigInteger('users_id');
            $table->bigInteger('empresas_id')->default(0);
            $table->bigInteger('escuelas_id')->default(0);
            $table->integer('beca')->default(0);
            $table->integer('descuento')->default(0);
            $table->bigInteger('lineas_negocio_id');
            $table->bigInteger('programas_id');
            $table->bigInteger('periodos_id');
            $table->tinyInteger('forma_cobro');
            $table->double('inscripcion');
            $table->double('mensualidad');
            $table->string('tarjeta_digitos',4);
            $table->tinyInteger('estado')->default(1);
            $table->integer('beca_banner')->default(0);
            $table->integer('descuento_banner')->default(0);
            $table->integer('beca_dev')->default(0);
            $table->integer('descuento_dev')->default(0);
            $table->tinyInteger('motivo_beca')->default(0);
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
        Schema::dropIfExists('inscritos');
    }
}
