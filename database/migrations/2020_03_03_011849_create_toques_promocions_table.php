<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToquesPromocionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toques_promocions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_id');
            $table->bigInteger('periodos_id');
            $table->integer('citas_generadas');
            $table->integer('citas_atendidas');
            $table->integer('llamadas');
            $table->integer('fichas');
            $table->integer('avanzados');
            $table->integer('inscritos');
            $table->tinyInteger('comision')->default(1);
            $table->tinyInteger('estado')->default(1);
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
        Schema::dropIfExists('toques_promocions');
    }
}
