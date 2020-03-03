<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_banner',10)->nullable();
            $table->string('name');
            $table->string('apellidos');
            $table->string('email',191)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('curp',20)->nullable();
            $table->string('rfc',10)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('no_nomina',10)->nullable();
            $table->bigInteger('cargos_id');
            $table->tinyInteger('estado')->default(1);
            //Adicionales
            $table->text('comentario', '500')->nullable();
            $table->string('adicional1')->nullable();
            $table->string('adicional2')->nullable();
            $table->string('adicional3')->nullable();
            $table->string('adicional4')->nullable();
            //Permisos Avances promocion
            $table->tinyInteger('nuevo_avance_promo')->default(0);
            $table->tinyInteger('consulta_avance_promo')->default(0);
            $table->tinyInteger('consulta_avance_promo_general')->default(0);
            $table->tinyInteger('cancelar_avace_promo')->default(0);
            //Permisos Inscritos Promocion
            $table->tinyInteger('nuevo_inscrito_promo')->default(0);
            $table->tinyInteger('consulta_inscrito_promo')->default(0);
            $table->tinyInteger('edicion_inscrito_promo')->default(0);
            $table->tinyInteger('consulta_inscrito_promo_general')->default(0);
            //Permisos Prospeccion Promocion
            $table->tinyInteger('consulta_prospeccion_promo')->default(0);
            $table->tinyInteger('consulta_prospeccion_promo_general')->default(0);
            //Permisos Periodos Promocion
            $table->tinyInteger('nuevo_periodo_promo')->default(0);
            $table->tinyInteger('consulta_periodo_promo')->default(0);
            $table->tinyInteger('editar_periodo_promo')->default(0);
            $table->tinyInteger('cancelar_periodo_promo')->default(0);
            // tags de tiempo
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
