<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorarioMateriaDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_materia_docente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('crn',10);
            $table->string('descripcion');
            $table->string('id_docente',10);
            $table->tinyInteger('dia');
            $table->date('fecha_vig_ini');
            $table->date('fecha_vig_fin');
            $table->time('hora_ini');
            $table->time('hora_fin');
            $table->string('grupo');
            $table->string('calendario',200);
            $table->text('comentario')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_materia_docentes');
    }
}
