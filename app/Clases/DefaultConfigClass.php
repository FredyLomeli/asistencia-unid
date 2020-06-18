<?php namespace App\Clases;

use App\Configuraciones;
use Illuminate\Support\Facades\Session;

class DefaultConfig
{
    public function setDefaultConfigByUser($user_id){

        //Configuraciones Captura Papeletas
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaCapturaPapeletas',
            'value'     => 'Usuario,Linea de Negocio,Escuela,Empresa,Capturadas',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaCapturaPapeletas',
            'value'     => 'users_id,lineas_negocio_id,escuelas_id,empresas_id,cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaCapturaPapeletas',
            'value'     => 'Usuario,Linea de Negocio,Escuela,Empresa,Capturadas',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaCapturaPapeletas',
            'value'     => 'users_id,lineas_negocio_id,escuelas_id,empresas_id,cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoCapturaPapeletas',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoCapturaPapeletas',
            'value'     => 'DESC',
        ]);

        //Configuraciones Convenios
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaConvenios',
            'value'     => 'Empresa,Escuela,Convenio Beca,Convenio Servicio,'.
                'Convenio Estadia,Fecha,Vigencia,Representante',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaConvenios',
            'value'     => 'empresas_id,escuelas_id,conv_promo,conv_servicio,'.
                'conv_estadia,fecha_conv,vigencia_conv,nombre_representante',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaConvenios',
            'value'     => 'Empresa,Escuela,Convenio Beca,Convenio Servicio,'.
                'Convenio Estadia,Fecha,Vigencia,Representante',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaConvenios',
            'value'     => 'empresas_id,escuelas_id,conv_promo,conv_servicio,'.
                'conv_estadia,fecha_conv,vigencia_conv,nombre_representante',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoCapturaConvenios',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoCapturaConvenios',
            'value'     => 'DESC',
        ]);

        //Configuraciones Empresas
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaEmpresas',
            'value'     => 'Nombre,Razon Social,Contacto,Celular,Municipio,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaEmpresas',
            'value'     => 'nombre,razon_social,contacto,celular,municipio,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaEmpresas',
            'value'     => 'Nombre,Razon Social,Contacto,Celular,Municipio,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaEmpresas',
            'value'     => 'nombre,razon_social,contacto,celular,municipio,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoEmpresas',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoEmpresas',
            'value'     => 'DESC',
        ]);

        //Configuraciones Escuelas
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaEscuelas',
            'value'     => 'nombre,tipificacion_promo,secundaria,prepa,universidad,municipio,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaEscuelas',
            'value'     => 'Nombre,Tipificacion,Secundaria,Prepa,Universidad,Municipio,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaEscuelas',
            'value'     => 'nombre,tipificacion_promo,secundaria,prepa,universidad,municipio,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaEscuelas',
            'value'     => 'Nombre,Tipificacion,Secundaria,Prepa,Universidad,Municipio,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoEscuelas',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoEscuelas',
            'value'     => 'DESC',
        ]);

        //Configuraciones Inscritos
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaInscritos',
            'value'     => 'ID,Empresa,Escuela,% Beca,% Descuento,Programa,Periodo,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaInscritos',
            'value'     => 'id_banner,empresas_id,escuelas_id,beca,descuento,programas_id,periodos_id,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaInscritos',
            'value'     => 'ID,Empresa,Escuela,% Beca,% Descuento,Programa,Periodo,Estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaInscritos',
            'value'     => 'id_banner,empresas_id,escuelas_id,beca,descuento,programas_id,periodos_id,estado',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoCapturaInscritos',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoCapturaInscritos',
            'value'     => 'DESC',
        ]);

        //Configuraciones Lineas de Negocio
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaLineasNegocio',
            'value'     => 'Nombre,Abreviatura,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaLineasNegocio',
            'value'     => 'descripcion,abreviatura,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaLineasNegocio',
            'value'     => 'Nombre,Abreviatura,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaLineasNegocio',
            'value'     => 'descripcion,abreviatura,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoLineasNegocio',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoLineasNegocio',
            'value'     => 'DESC',
        ]);

        //Configuraciones Metas Promotores
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaMetasPromotores',
            'value'     => 'Usuario,Periodo,Cantidad,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaMetasPromotores',
            'value'     => 'users_id,periodos_id,catidad,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaMetasPromotores',
            'value'     => 'Usuario,Periodo,Cantidad,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaMetasPromotores',
            'value'     => 'users_id,periodos_id,catidad,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoMetasPromotores',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoMetasPromotores',
            'value'     => 'DESC',
        ]);

        //Configuraciones Papeletas
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaPapeletas',
            'value'     => 'Prospección,Comision,Linea de Negocio,Cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaPapeletas',
            'value'     => 'prospeccion_id,toques_promo_id,lineas_negocio_id,cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaPapeletas',
            'value'     => 'Prospección,Comision,Linea de Negocio,Cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaPapeletas',
            'value'     => 'prospeccion_id,toques_promo_id,lineas_negocio_id,cantidad',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoPapeletas',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoPapeletas',
            'value'     => 'DESC',
        ]);

        //Configuraciones Periodos
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaPeriodos',
            'value'     => 'Descripcion,Periodo,Meta,Fecha Inicio,Fecha Fin',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaPeriodos',
            'value'     => 'descripcion,periodo,meta_general,fecha_inicio,fecha_fin',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaPeriodos',
            'value'     => 'Descripcion,Periodo,Meta,Fecha Inicio,Fecha Fin',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaPeriodos',
            'value'     => 'descripcion,periodo,meta_general,fecha_inicio,fecha_fin',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoPeriodos',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoPeriodos',
            'value'     => 'DESC',
        ]);

        //Configuraciones Programas
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaProgramas',
            'value'     => 'Linea de Negocio,Nombre,Abreviatura,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaProgramas',
            'value'     => 'lineas_negocio_id,descripcion,abreviatura,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaProgramas',
            'value'     => 'Linea de Negocio,Nombre,Abreviatura,Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaProgramas',
            'value'     => 'lineas_negocio_id,descripcion,abreviatura,comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoProgramas',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoProgramas',
            'value'     => 'DESC',
        ]);

        //Configuraciones Prospeccion
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaProspeccion',
            'value'     => 'Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaProspeccion',
            'value'     => 'comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaProspeccion',
            'value'     => 'Comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaProspeccion',
            'value'     => 'comentario',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoProspeccion',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoProspeccion',
            'value'     => 'DESC',
        ]);

        //Configuraciones Toques Desglose
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaToquesDesglose',
            'value'     => 'Usuario,Linea de Negocio,Cantidad,Tipo',

        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaToquesDesglose',
            'value'     => 'toques_promo_id,lineas_negocio_id,cantidad,tipo_movimiento',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaToquesDesglose',
            'value'     => 'Usuario,Linea de Negocio,Cantidad,Tipo',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaToquesDesglose',
            'value'     => 'toques_promo_id,lineas_negocio_id,cantidad,tipo_movimiento',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoToquesDesglose',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoToquesDesglose',
            'value'     => 'DESC',
        ]);

        //Configuraciones Toques Promocion
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'NombreCamposTablaToquesPromocion',
            'value'     => 'Usuario,Periodo,Citas Generadas,Citas Atendidas,Llamadas,Fichas,Avanzados,Inscritos',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CamposTablaToquesPromocion',
            'value'     => 'users_id,periodos_id,citas_generadas,citas_atendidas,llamadas,fichas,avanzados,inscritos',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroNombreCamposTablaToquesPromocion',
            'value'     => 'Usuario,Periodo,Citas Generadas,Citas Atendidas,Llamadas,Fichas,Avanzados,Inscritos',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'FiltroCamposTablaToquesPromocion',
            'value'     => 'users_id,periodos_id,citas_generadas,citas_atendidas,llamadas,fichas,avanzados,inscritos',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'CantidadListadoToquesPromocion',
            'value'     => '15',
        ]);
        Configuraciones::create([
            'users_id'  => $user_id,
            'config'    => 'OrdenListadoToquesPromocion',
            'value'     => 'DESC',
        ]);
    }
}
