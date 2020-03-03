<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapeletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papeletas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_id');
            $table->bigInteger('prospeccion_id')->default(0);
            $table->bigInteger('toques_promo_id')->default(0);
            $table->bigInteger('lineas_negocio_id');
            $table->integer('cantidad');
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
        Schema::dropIfExists('papeletas');
    }
}
