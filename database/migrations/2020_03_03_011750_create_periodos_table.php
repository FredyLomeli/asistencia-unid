<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion',50);
            $table->string('periodo',10);
            $table->integer('meta_general');
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->double('costo_inscripcion_lic');
            $table->double('costo_mensualidad_lic');
            $table->double('costo_inscripcion_eje');
            $table->double('costo_mensualidad_eje');
            $table->double('costo_mensualidad_mae');
            $table->double('costo_mensualidad_mae_edu');
            $table->tinyInteger('estado')->default(1);
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
        Schema::dropIfExists('periodos');
    }
}
