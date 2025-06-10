<?php
require_once "conexion.php";

class SociedadModelo {
    public static function obtenerSociedades() {
        $conexion = Conexion::conectar();
        $sql = "
             SELECT 
		  b.id_solicitud,
		  CONCAT(c.nombre, ' ', c.apellido) AS nombre_completo,
		  c.emails,
		  STRING_AGG(DISTINCT a.nombre_sociedad, ', ') AS sociedades,
		  COUNT(DISTINCT a.nombre_sociedad) AS total_sociedades,
		  (
			SELECT STRING_AGG(DISTINCT e.estado, ', ')
			FROM personas_sociedad ps
			LEFT JOIN LATERAL jsonb_array_elements_text((ps.datos_sociedad->'estadopais')::jsonb) AS elem(estado_id) ON true
			LEFT JOIN estados e ON e.id_estado = elem.estado_id::int
			WHERE ps.fk_solicitud = b.id_solicitud
			  AND ps.datos_sociedad->>'activarSociedad' = 'on'
		  ) AS estado_pais
		FROM 
		  personas_sociedad AS a
		INNER JOIN 
		  solicitud AS b ON a.fk_solicitud = b.id_solicitud
		INNER JOIN 
		  sociedad AS c ON b.fk_cliente = c.uuid
		WHERE 
		  a.datos_sociedad->>'activarSociedad' = 'on'

		GROUP BY 
		  b.id_solicitud, c.nombre, c.apellido, c.emails
		ORDER BY 
		  b.id_solicitud;


        ";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
	
	 public static function obtenerEstadosPorSociedad($nombreSociedad) {
        $conexion = Conexion::conectar();
        
        $sql = "
            SELECT
                ps.nombre_sociedad,
                string_agg(e.estado, ', ') AS estados
            FROM
                personas_sociedad ps
            LEFT JOIN LATERAL jsonb_array_elements_text((ps.datos_sociedad->'estadopais')::jsonb) AS elem(estado_id) ON true
            LEFT JOIN estados e ON e.id_estado = elem.estado_id::int
            WHERE
                ps.nombre_sociedad = :nombre_sociedad
                AND ps.datos_sociedad->>'activarSociedad' = 'on'
            GROUP BY
                ps.nombre_sociedad
        ";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre_sociedad', $nombreSociedad, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
	public static function obtenerSociedadesConMultiplesEstados($idSolicitud) {
    $conexion = Conexion::conectar();
    $sql = "
        SELECT nombre_sociedad
        FROM personas_sociedad
        WHERE fk_solicitud = :idSolicitud
          AND datos_sociedad->>'activarSociedad' = 'on'
          AND jsonb_array_length(datos_sociedad->'estadopais') > 1
    ";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':idSolicitud', $idSolicitud, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN); // Devuelve solo array de nombres
}

    public static function obtenerTablaInactivas() {
      $conexion = Conexion::conectar();
      $sql = "
              SELECT 
    b.id_solicitud,
    CONCAT(c.nombre, ' ', c.apellido) AS nombre_completo,
    STRING_AGG(a.nombre_sociedad, ', ') AS sociedades,
    COUNT(a.nombre_sociedad) AS total_sociedades
FROM 
    personas_sociedad AS a
INNER JOIN 
    solicitud AS b ON a.fk_solicitud = b.id_solicitud
INNER JOIN 
    sociedad AS c ON b.fk_cliente = c.uuid
WHERE 
    NOT jsonb_exists(a.datos_sociedad, 'activarSociedad')
GROUP BY 
    b.id_solicitud, c.nombre, c.apellido
ORDER BY 
    b.id_solicitud;

      ";
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerRenovacionEnviadas() {
      $conexion = Conexion::conectar();
      $sql = "
         SELECT 
        b.id_solicitud,
        CONCAT(c.nombre, ' ', c.apellido) AS nombre_completo,
        STRING_AGG(a.nombre_sociedad, ', ') AS sociedades,
        COUNT(a.nombre_sociedad) AS total_sociedades
        FROM 
          personas_sociedad AS a
        INNER JOIN 
          solicitud AS b ON a.fk_solicitud = b.id_solicitud
        INNER JOIN 
          sociedad AS c ON b.fk_cliente = c.uuid
        where a.correo_enviado = 'true'
        GROUP BY 
          b.id_solicitud, c.nombre, c.apellido
        ORDER BY 
          b.id_solicitud;

      ";
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTotalSociedades() {
      $conexion = Conexion::conectar();
      $sql = "SELECT COUNT(id_personas_sociedad) AS total FROM personas_sociedad";
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC); // retorna un solo valor
  }

  public static function obtenerSociedadesActivas() {
    $conexion = Conexion::conectar();
    $sql = "SELECT COUNT(id_personas_sociedad) AS total FROM personas_sociedad WHERE datos_sociedad->>'activarSociedad' = 'on'";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function obtenerSociedadesInactivas() {
    $conexion = Conexion::conectar();
    $sql = "SELECT COUNT(id_personas_sociedad) AS total 
FROM personas_sociedad 
WHERE NOT jsonb_exists(datos_sociedad, 'activarSociedad');";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function obtenerSociedadesEnvidaCorreo() {
    $conexion = Conexion::conectar();
    $sql = "SELECT COUNT(id_personas_sociedad) AS total FROM personas_sociedad WHERE correo_enviado = true";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function marcarCorreoEnviado($id) {
    $conexion = Conexion::conectar();
    $sql = "UPDATE personas_sociedad SET correo_enviado = true, fecha_envio_renovacion = NOW() 
    WHERE fk_solicitud = :id AND 
    datos_sociedad->>'activarSociedad' = 'on' 
    AND correo_enviado = false";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
  
	 public static function enviarCorreoRenovacion($destino, $asunto, $mensajeHTML)
{
	require_once '../resource/PHPMailer/Exception.php';
	require_once '../resource/PHPMailer/PHPMailer.php';
	require_once '../resource/PHPMailer/SMTP.php';

	$mail = new PHPMailer\PHPMailer\PHPMailer(true);
	try {
		// 🔧 Habilitar debug ANTES de enviar
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = function($str, $level) {
			error_log("SMTP DEBUG [$level]: $str");
			file_put_contents(__DIR__ . '/smtp_debug.log', "[$level] $str\n", FILE_APPEND);
		};

		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'evotics28@gmail.com';
		$mail->Password   = 'wqaobpgqmqtmfwcu';
		$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465;

		$mail->setFrom('evotics28@gmail.com', 'Sistema Patrimonium');
		$mail->addAddress("serazo31@gmail.com"); // Aquí usas la variable real
		$mail->addCC('vargasandassociates@gmail.com', 'Notificación CC');

		$mail->isHTML(true);
		$mail->Subject = $asunto;
		$mail->Body = $mensajeHTML;

		$mail->send();
		return true;

	} catch (Exception $e) {
		error_log("EXCEPCIÓN PHPMailer: " . $mail->ErrorInfo);
		return "Error al enviar correo: " . $mail->ErrorInfo;
	}
}

public static function obtenerConteoPorEstado($id_solicitud) {
    $conexion = Conexion::conectar();

    $sql = "
       SELECT e.estado, COUNT(*) AS cantidad
		FROM (
			SELECT jsonb_array_elements_text(datos_sociedad->'estadopais') AS id_estado
			FROM personas_sociedad
			WHERE fk_solicitud = :id_solicitud
			  AND datos_sociedad->>'activarSociedad' = 'on'
		) AS sub
		JOIN estados e ON e.id_estado::text = sub.id_estado
		WHERE e.id_estado::text <> '8'
		GROUP BY e.estado
		ORDER BY cantidad DESC;

    ";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_solicitud', $id_solicitud, PDO::PARAM_INT);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ convertir a objeto simple tipo: { "100": 4, "9": 2 }
    $respuesta = [];
		foreach ($resultados as $fila) {
		  $respuesta[$fila['estado']] = (int)$fila['cantidad'];
		}

    return $respuesta;
}

}
