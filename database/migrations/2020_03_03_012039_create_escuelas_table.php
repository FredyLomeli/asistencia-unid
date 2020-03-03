<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('clave_cct')->nullable();
            $table->string('tipificacion_promo')->nullable();
            $table->string('contacto')->nullable();
            $table->string('celular',50)->nullable();
            $table->string('telefono',50)->nullable();
            $table->tinyInteger('tipo_escuela')->default(0);
            $table->tinyInteger('secundaria')->default(0);
            $table->tinyInteger('prepa')->default(0);
            $table->tinyInteger('universidad')->default(0);
            $table->string('domicilio')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('codigo_postal',10)->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('escuelas');
    }
}
