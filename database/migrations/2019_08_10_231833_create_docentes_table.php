<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_banner',10)->unique();
            $table->string('nombre',100);
            $table->string('apellido_paterno',100)->nullable();
            $table->string('apellido_materno',100)->nullable();
            $table->tinyInteger('estatus');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->text('comentario')->nullable();
            $table->timestamp('fecha_baja')->nullable();
            $table->string('adicional_1')->nullable();
            $table->string('adicional_2')->nullable();
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
        Schema::dropIfExists('docentes');
    }
}
