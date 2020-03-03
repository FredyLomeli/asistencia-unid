<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('razon_social');
            $table->string('rfc',13)->nullable();
            $table->string('contacto')->nullable();
            $table->string('celular',50)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('perfil_promo',3)->nullable();
            $table->string('sector_promo',10)->nullable();
            $table->string('alcanze_geo_promo',30)->nullable();
            $table->string('programa_meta_promo',100)->nullable();
            $table->string('giro_vinc')->nullable();
            $table->string('covertura_vinc',100)->nullable();
            $table->string('tipo_vinc',50)->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
