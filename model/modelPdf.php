<?php
require_once('conexion.php');

class ModelPdf {

    public static function obtenerDatosAdicionales($id_solicitud) {
        try {
            $sqlListarSolicitud = "select 
                                    a.nombre_cliente as nombre_llc,
                                    a.sr_numero,
                                    a.date_organization, 
                                    a.state_organization, 
                                    a.principal_business, 
                                    a.managing_members, 
                                    a.bank_account, 
                                    a.fiscal_year, 
                                    a.ein, 
                                    a.date_annual_meeting, 
                                    a.secretary, 
                                    a.treasurer, 
                                    a.members, 
                                    a.initial_manager,
                                    c.nombre as nombre_cliente,
                                    c.apellido as apellido_cliente
                                   from datos_adicionales a
                                   inner join solicitud as b ON(a.fk_solicitud =b.id_solicitud)
                                   inner join sociedad as c ON (c.id_sociedad = b.fk_persona)
                                   WHERE a.fk_solicitud = :id_solicitud";
            $listaSolicutd = Conexion::conectar()->prepare($sqlListarSolicitud);
            $listaSolicutd->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
            $listaSolicutd->execute();
            return $listaSolicutd->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>