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
            $table->string('email','191')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('curp',20)->nullable();
            $table->string('rfc',15)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('no_nomina',10)->nullable();
            $table->bigInteger('cargos_id');
            $table->tinyInteger('estado')->default(1);
            $table->string('user_edit')->nullable();
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
            $table->tinyInteger('nuevo_prospeccion_promo')->default(0);
            $table->tinyInteger('consulta_prospeccion_promo')->default(0);
            $table->tinyInteger('edicion_prospeccion_promo')->default(0);
            $table->tinyInteger('consulta_prospeccion_promo_general')->default(0);
            //Permisos Periodos Promocion
            $table->tinyInteger('nuevo_periodo_promo')->default(0);
            $table->tinyInteger('consulta_periodo_promo')->default(0);
            $table->tinyInteger('editar_periodo_promo')->default(0);
            $table->tinyInteger('cancelar_periodo_promo')->default(0);
            //Permisos programas Academicos
            $table->tinyInteger('nuevo_programa_acade')->default(0);
            $table->tinyInteger('consulta_programa_acade')->default(0);
            $table->tinyInteger('editar_programa_acade')->default(0);
            $table->tinyInteger('cancelar_programa_acade')->default(0);
            //Permisos Lineas Negocio
            $table->tinyInteger('nuevo_linea_negocio')->default(0);
            $table->tinyInteger('consulta_linea_negocio')->default(0);
            $table->tinyInteger('editar_linea_negocio')->default(0);
            $table->tinyInteger('cancelar_linea_negocio')->default(0);
            //Permisos Cargos
            $table->tinyInteger('nuevo_cargo')->default(0);
            $table->tinyInteger('consulta_cargo')->default(0);
            $table->tinyInteger('editar_cargo')->default(0);
            $table->tinyInteger('cancelar_cargo')->default(0);
            //Permisos papeletas
            $table->tinyInteger('nuevo_papeletas_promo')->default(0);
            $table->tinyInteger('consulta_papeletas_promo')->default(0);
            $table->tinyInteger('editar_papeletas_promo')->default(0);
            $table->tinyInteger('cancelar_papeletas_promo')->default(0);
            //Permisos empresas
            $table->tinyInteger('nuevo_empresa')->default(0);
            $table->tinyInteger('consulta_empresa')->default(0);
            $table->tinyInteger('editar_empresa')->default(0);
            $table->tinyInteger('cancelar_empresa')->default(0);
            //Permisos escuela
            $table->tinyInteger('nuevo_escuela')->default(0);
            $table->tinyInteger('consulta_escuela')->default(0);
            $table->tinyInteger('editar_escuela')->default(0);
            $table->tinyInteger('cancelar_escuela')->default(0);
            //Permisos convenios vinculacion
            $table->tinyInteger('nuevo_convenios_vinc')->default(0);
            $table->tinyInteger('consulta_convenios_vinc')->default(0);
            $table->tinyInteger('editar_convenios_vinc')->default(0);
            $table->tinyInteger('cancelar_convenios_vinc')->default(0);
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
