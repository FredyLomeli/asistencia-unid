<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_docente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('docente_banner',10);
            $table->string('docente_nombre',250);
            $table->string('crn',10);
            $table->string('crn_descripcion',200);
            $table->string('tipo_registro',10);
            $table->tinyInteger('dia');
            $table->timestamp('fecha_hora_reg')->useCurrent();
            $table->string('grupo',200)->nullable();
            $table->timestamp('fecha_modificacion')->useCurrent();
            $table->string('adicional1',200)->nullable();
            $table->string('adicional2',200)->nullable();
            $table->string('adicional3',200)->nullable();
            $table->string('adicional4',200)->nullable();
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
        Schema::dropIfExists('registro_docentes');
    }
}
