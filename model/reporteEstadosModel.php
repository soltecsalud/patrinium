<?php
require_once 'Conexion.php';

class MapaEstadosModel {
       private static $isoMapping = [
        'DELAWARE' => ['id' => 'US-DE', 'lat' => 38.9108, 'lon' => -75.5277],
        'FLORIDA' => ['id' => 'US-FL', 'lat' => 27.9944, 'lon' => -81.7603],
        'TEXAS' => ['id' => 'US-TX', 'lat' => 31.9686, 'lon' => -99.9018],
        'CALIFORNIA' => ['id' => 'US-CA', 'lat' => 36.7783, 'lon' => -119.4179]
       //se debe colocar las latitudes y longitudes en la tabla estados
    ];

    public static function obtenerDatosEstados() {
        $conexion = Conexion::conectar();
        $query = "
            SELECT 
                e.estado AS estado,
                COUNT(*) AS total
            FROM 
                personas_sociedad ps
            LEFT JOIN LATERAL jsonb_array_elements_text((ps.datos_sociedad->'estadopais')::jsonb) AS elem(estado_id) ON true
            LEFT JOIN estados e ON e.id_estado = elem.estado_id::int
            WHERE 
                ps.datos_sociedad->>'activarSociedad' = 'on'
            GROUP BY 
                e.estado
            ORDER BY 
                total DESC
        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      //hacer el mapeo para amcharts
   
        $mappedData = [];
        foreach ($result as $row) {
            if (isset(self::$isoMapping[$row['estado']])) {
                $estadoData = self::$isoMapping[$row['estado']];
                $mappedData[] = [
                    'id' => $estadoData['id'],
                    'value' => $row['total'],
                    'latitude' => $estadoData['lat'],
                    'longitude' => $estadoData['lon']
                ];
            }
        }
        return $mappedData;
    }
	
	 public static function obtenerSociedadPorEstado() {
        $conexion = Conexion::conectar();
        $query = "
          SELECT 
				ps.nombre_sociedad,
				e.estado
			FROM 
				personas_sociedad ps
			LEFT JOIN LATERAL jsonb_array_elements_text((ps.datos_sociedad->'estadopais')::jsonb) AS elem(estado_id) ON true
			LEFT JOIN estados e ON e.id_estado = elem.estado_id::int
			WHERE 
				ps.datos_sociedad->>'activarSociedad' = 'on'
			GROUP BY 
				ps.nombre_sociedad, e.estado
			HAVING 
				COUNT(e.estado) = 1
			ORDER BY 
				ps.nombre_sociedad;

        ";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>