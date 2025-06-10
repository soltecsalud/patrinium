<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} elseif ($_SESSION['crear generales'] === false) {
    echo 'Acceso no autorizado.';
    exit();
}

setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PatrimoniumAPP || Enviar Renovación</title>
  <?php include_once "head/head_views.php"; ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<style>
  .cke_notifications_area {
    display: none !important;
  }
</style>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <section class="content">
      <div class="container-fluid">
        <h3>Sociedades Activas Para Renovacion</h3>
		
        <div class="card">
          <div class="card-body">
            <div class="row text-center mb-4">
              <div class="col-md-3">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3 id="totalSociedades">...</h3>
                    <p>Total de Sociedades</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-building"></i>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3 id="totalActivas">...</h3>
                    <p>Sociedades Activas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-check-circle"></i>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3 id="totalInactivas">...</h3>
                    <p>Sociedades Inactivas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-times-circle"></i>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3 id="totalCorreoEnviado">...</h3>
                    <p>Correo Enviado</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>
              </div>
            </div>

            <table id="tablaSociedades" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID Solicitud</th>
                  <th>Nombre Completo</th>
                  <th>Sociedades</th>
                  <th>Total Sociedades Activas</th>
                  <th>Annual Report (USD-5.00)</th>
                  <th>Acción</th>
                </tr>
              </thead>
            </table>
          </div> <!-- cierre de card-body -->
        </div> <!-- cierre de card -->
      </div> <!-- cierre de container-fluid -->

      <div class="container-fluid">
        <h3>Sociedades Inactivas</h3>
        <div class="card">
          <div class="card-body">
            <table id="tablaSociedadesInactivas" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID Solicitud</th>
                  <th>Nombre Completo</th>
                  <th>Sociedades</th>
                  <th>Total Sociedades Inactivas</th>
                </tr>
              </thead>
            </table>
          </div> <!-- cierre de card-body -->
        </div> <!-- cierre de card -->
      </div> <!-- cierre de container-fluid -->

      <div class="container-fluid">
        <h3>Sociedades Renovacion Enviada</h3>
        <div class="card">
          <div class="card-body">
            <table id="tablaSociedadesRenovacionEnviada" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID Solicitud</th>
                  <th>Nombre Completo</th>
                  <th>Sociedades</th>
                  <th>Total Sociedades Inactivas</th>
                </tr>
              </thead>
            </table>
          </div> <!-- cierre de card-body -->
        </div> <!-- cierre de card -->
      </div> <!-- cierre de container-fluid -->

    </section> <!-- cierre de section.content -->
  </div> <!-- cierre de wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="modalCorreo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" style="max-width: 95%;">
      <form id="formCorreo">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Previsualización del Correo</h5>
          
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Para:</label>
              <input type="email" class="form-control" name="correo_destino" required value="cliente@ejemplo.com">
            </div>
            <div class="form-group">
              <label>Asunto:</label>
              <input type="text" class="form-control" name="asunto" required value="Resumen de sociedades y cargos">
            </div>
            <div class="form-group">
              <label>Mensaje:</label>
              <textarea name="mensaje" id="mensaje" class="form-control" rows="10"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Enviar correo</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include_once "footer/footer_views.php"; ?>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  // 🔹 1. Funciones globales
  function numeroALetras(num) {
    const formatter = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'USD' });
    return formatter.format(num);
  }
function labelEstadosSociedades(data) {
  const id_solicitud = data.id_solicitud;

  return new Promise((resolve, reject) => {
    $.ajax({
      url: '../controller/envioRenovacionController.php?conteo_estados=1',
      method: 'GET',
      data: { id_solicitud: id_solicitud },
      dataType: 'json',
      success: function (respuesta) {
        resolve(respuesta); // 👈 Devuelve el objeto tipo { FLORIDA: 3, EXTRANJERA: 1 }
      },
      error: function () {
        reject("Error al obtener el conteo de estados");
      }
    });
  });
}

function obtenerEstados(nombreSociedad) {
  return $.ajax({
    url: '../controller/envioRenovacionController.php',
    type: 'GET',
    data: { nombre_sociedad: nombreSociedad },
    dataType: 'json'
  });
}

function generarCorreoHTML(data, valorAnnualReport, sociedadesMultiplesEstados = []) {
  const cargos = [
    { nombre: "ANNUAL REPORT", valor: parseFloat(valorAnnualReport) || 0 },
    { nombre: "ANONYMITY SERVICES", valor: 1.00 },
    { nombre: "FRANCHAISE TAX", valor: 1.00 },
    { nombre: "STATE TAX", valor: 1.00 },
    { nombre: "REGISTER AGENT", valor: 1.00 },
    { nombre: "PROCESS SERVICES", valor: 1.00 },
    { nombre: "OTROS", valor: 0.00 }
  ];

  const valorPorSociedad = cargos.reduce((total, cargo) => total + cargo.valor, 0);
  const totalCorporaciones = data.total_sociedades * valorPorSociedad;

  const cantidadMultiplesEstados = sociedadesMultiplesEstados.length;
  const valorMultiplesEstados = cantidadMultiplesEstados * 750;

  const totalFinal = totalCorporaciones + valorMultiplesEstados;
  const totalTexto = numeroALetras(totalFinal);

  const filasCargos = cargos
    .map(c => `<tr><td>${c.nombre}</td><td style="text-align: right;">${c.valor.toFixed(2)}</td></tr>`)
    .join('');

  const listaEstados = data.estado_pais
    ? data.estado_pais.split(',').map(e => `<li>${e.trim()}</li>`).join('')
    : '<li>No hay estados registrados</li>';

  const listaEmpresas = data.sociedades
    .split(',')
    .map(s => `<li>${s.trim()}</li>`)
    .join('');

  return `
    <p style="margin:0;color:#000000;"><strong>Fecha Notificaci&oacute;n:</strong><?php echo strftime('%d de %B de %Y'); ?></p>
    <p style="margin:0;color:#000000;"><strong>Cliente:</strong> ${data.nombre_completo}</p>
    <p style="margin:0;color:#000000;"><strong>Pa&iacute;s:</strong> COLOMBIA</p>
    <div style="margin:10px 0; color:#000000;">
	  <strong style="color:#000000;">Estados Asociados:</strong>
	  <ul style="padding-left:20px; margin:5px 0; color:#000000;">
		${listaEstados}
	  </ul>
	</div>
    <p style="margin:0 0 10px;color:#000000;"><strong>Oficina:</strong> VARGAS & ASSOCIATES</p>

    <div style="background-color:#ccd9f6; padding:10px; border:2px solid #999; margin:10px auto; width:89%;">
      <p style="margin:0;"><strong>Observaciones:</strong></p><br>
      <p style="margin:0; font-size:0.9em;">A CONTINUACI&Oacute;N ENCONTRAR&Aacute; LAS CORPORACIONES REGISTRADAS EN EL ESTADO DE DELAWARE, A LAS QUE DEBEMOS ATENDER EL PAGO POR LAS ANUALIDADES POR EL A&Ntilde;O 2025</p><br>
      <p style="margin:0; font-size:1.2em;"><b><strong>NOTE # 1:</strong> If these charges are not settled immediately, the corporations will be dissolved due to lack of legal representation in the USA and forced dissolution costs may be higher.</b></p>
    </div>

    <table border="2" cellpadding="5" cellspacing="0" style="width:90.5%; border-collapse:collapse; margin:0 auto; background-color:#e8f6f5;">
      <thead>
        <tr style="background-color: #c3e6e3;">
          <th colspan="2" style="font-weight:bold; text-align:center;">CARGOS LEGALES POR SU CORPORACI&Oacute;N</th>
        </tr>
      </thead>
      <tbody>
        ${filasCargos}
        <tr style="font-weight:bold;">
          <td style="text-align:left;">TOTAL CARGOS:</td>
          <td style="text-align:right; color:red;">${valorPorSociedad.toFixed(2)}</td>
        </tr>
        <tr style="font-weight:bold;">
          <td style="text-align:left;">TOTAL POR TODAS LAS CORPORACIONES (${data.total_sociedades} x ${valorPorSociedad.toFixed(2)}):</td>
          <td style="text-align:right; color:red;">${totalCorporaciones.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        </tr>
        ${cantidadMultiplesEstados > 0 ? `
        <tr style="font-weight:bold;">
          <td style="text-align:left;">CARGO POR SOCIEDADES EN VARIOS ESTADOS (${cantidadMultiplesEstados} x 750 USD):</td>
          <td style="text-align:right; color:red;">${valorMultiplesEstados.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        </tr>
        ` : ''}
        <tr style="font-weight:bold; background-color: #d1e7dd;">
          <td style="text-align:left;">TOTAL FINAL A PAGAR:</td>
          <td style="text-align:right; color:red;">${totalFinal.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        </tr>
      </tbody>
    </table>

    <div style="background:#d9d9d9; padding:10px; margin:10px auto; border:2px solid #999; width:89%;">
      <p style="margin:0;"><strong>Son:</strong> ${totalTexto.toUpperCase()} D&Oacute;LARES</p>
      <p style="text-align:center; margin:5px 0 0;">******************************************************</p>
    </div>

    <h4 style="color:red; margin:10px auto 5px; width:90%;"><strong>Empresas Notificadas:</strong></h4>
	<ol style="margin:0 auto; padding-left:20px; width:90%; color:#000000;">
	  ${listaEmpresas}
	</ol>
	<p style="color:#000000;">Saludos,<br>Jairo Vargas<br>6355 NW 36 St Ste 507<br>Virginia Gardens, FL. 33166</p>
    
  `;
}

// Copia de la funci��n original, adaptada para procesar valores espec��ficos por estado y conservar el mismo formato visual
function generarCorreoConEstadosHTML(data, valoresPorEstado = {}, sociedadesMultiplesEstados = [], valorAnnualReport = 0, cantidadPorEstado = {}) {
 
  const cargos = [
    { nombre: "ANONYMITY SERVICES", valor: 1.00 },
    { nombre: "FRANCHAISE TAX", valor: 1.00 },
    { nombre: "STATE TAX", valor: 1.00 },
    { nombre: "REGISTER AGENT", valor: 1.00 },
    { nombre: "PROCESS SERVICES", valor: 1.00 },
    { nombre: "OTROS", valor: 0.00 }
  ];
  
  //labelEstadosSociedades(data);
  
  //console.log('🟢 Entrando a generarCorreoConEstadosHTML');
  console.log('📦 data:', data);
  //console.log('📊 valoresPorEstado:', valoresPorEstado);
  //console.log('📌 sociedadesMultiplesEstados:', sociedadesMultiplesEstados);
//console.log('💵 valorAnnualReport:', valorAnnualReport);

  //console.log('📊 valoresPorEstado:', valoresPorEstado);
 
  sociedadesMultiplesEstados.forEach(soc => {
    const estado = (soc.estado || '').trim();
    if (!estado) return;
    cantidadPorEstado[estado] = (cantidadPorEstado[estado] || 0) + 1;
  });

  // ? Tomar valor de ANNUAL_REPORT_BASE desde valoresPorEstado y removerlo del objeto
  const baseAnnualReport = valoresPorEstado['ANNUAL_REPORT_BASE'] || 0;
  console.log("ANNUAL_REPORT_BASE:", baseAnnualReport);
  delete valoresPorEstado['ANNUAL_REPORT_BASE'];

  const subtotalAnnualReport = baseAnnualReport * data.total_sociedades;
  const filaAnnualReport = `<tr><td>ANNUAL REPORT (${data.total_sociedades} x ${baseAnnualReport.toFixed(2)})</td><td style="text-align:right;">${subtotalAnnualReport.toFixed(2)}</td></tr>`;

	const filasEstados = Object.entries(valoresPorEstado)
  .filter(([estado]) =>
    estado !== 'ANNUAL_REPORT_BASE' &&
    cantidadPorEstado.hasOwnProperty(estado) &&
    cantidadPorEstado[estado] > 0
  )
  .map(([estado, valorUnitario]) => {
    const cantidad = cantidadPorEstado[estado];
    const subtotal = valorUnitario * cantidad;

    return `
      <tr>
        <td>${estado} (${cantidad} × ${valorUnitario.toFixed(2)})</td>
        <td style="text-align:right;">${subtotal.toFixed(2)}</td>
      </tr>`;
  }).join('');

	console.log('🧾 filasEstados generadas:', filasEstados);

  const filasCargos = cargos.map(c =>
    `<tr><td>${c.nombre}</td><td style="text-align:right;">${c.valor.toFixed(2)}</td></tr>`
  ).join('');

  const totalPorSociedad = cargos.reduce((sum, c) => sum + c.valor, 0);
  const totalCorporaciones = data.total_sociedades * totalPorSociedad;

 const totalEstados = Object.entries(valoresPorEstado)
  .filter(([estado]) => cantidadPorEstado[estado] > 0)
  .reduce((sum, [estado, valorUnitario]) => {
    const cantidad = cantidadPorEstado[estado];
    return sum + (valorUnitario * cantidad);
  }, 0);
  const totalFinal = subtotalAnnualReport + totalCorporaciones + totalEstados;
  const totalTexto = numeroALetras(totalFinal);

  const listaEstados = data.estado_pais
    ? data.estado_pais.split(',').map(e => `<li>${e.trim()}</li>`).join('')
    : '<li>No hay estados registrados</li>';

  const listaEmpresas = data.sociedades
    .split(',')
    .map(s => `<li>${s.trim()}</li>`)
    .join('');

  return `
    <p style="margin:0;color:#000000;"><strong>Fecha Notificaci&oacute;n:</strong><?php echo strftime('%d de %B de %Y'); ?></p>
    <p style="margin:0;color:#000000;"><strong>Cliente:</strong> ${data.nombre_completo}</p>
    <p style="margin:0;color:#000000;"><strong>Pa&iacute;s:</strong> COLOMBIA</p>
    <div style="margin:10px 0; color:#000000;">
      <strong style="color:#000000;">Estados Asociados:</strong>
      <ul style="padding-left:20px; margin:5px 0; color:#000000;">
        ${listaEstados}
      </ul>
    </div>
    <p style="margin:0 0 10px;color:#000000;"><strong>Oficina:</strong> VARGAS & ASSOCIATES</p>

    <div style="background-color:#ccd9f6; padding:10px; border:2px solid #999; margin:10px auto; width:89%;">
      <p style="margin:0;"><strong>Observaciones:</strong></p><br>
      <p style="margin:0; font-size:0.9em;">A CONTINUACI&Oacute;N ENCONTRAR&Aacute; LAS CORPORACIONES REGISTRADAS EN EL ESTADO DE DELAWARE, A LAS QUE DEBEMOS ATENDER EL PAGO POR LAS ANUALIDADES POR EL A&Ntilde;O 2025</p><br>
      <p style="margin:0; font-size:1.2em;"><b><strong>NOTE # 1:</strong> If these charges are not settled immediately, the corporations will be dissolved due to lack of legal representation in the USA and forced dissolution costs may be higher.</b></p>
    </div>

    <table border="2" cellpadding="5" cellspacing="0" style="width:90.5%; border-collapse:collapse; margin:0 auto; background-color:#e8f6f5;">
      <thead>
        <tr style="background-color: #c3e6e3;">
          <th colspan="2" style="font-weight:bold; text-align:center;">CARGOS LEGALES POR SU CORPORACI&Oacute;N</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="2"><strong>CARGOS POR CORPORACI&Oacute;N</strong></td></tr>
        ${filaAnnualReport}
        ${filasCargos}
        <tr style="font-weight:bold;">
          <td style="text-align:left;">TOTAL CARGOS:</td>
          <td style="text-align:right; color:red;">${totalPorSociedad.toFixed(2)}</td>
        </tr>
        <tr style="font-weight:bold;">
          <td style="text-align:left;">TOTAL POR TODAS LAS CORPORACIONES (${data.total_sociedades} x ${totalPorSociedad.toFixed(2)}):</td>
          <td style="text-align:right; color:red;">${totalCorporaciones.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        </tr>
        ${filasEstados}
        <tr style="font-weight:bold; background-color: #d1e7dd;">
          <td style="text-align:left;">TOTAL FINAL A PAGAR:</td>
          <td style="text-align:right; color:red;">${totalFinal.toLocaleString('en-US', { style: 'currency', currency: 'USD' })}</td>
        </tr>
      </tbody>
    </table>

    <div style="background:#d9d9d9; padding:10px; margin:10px auto; border:2px solid #999; width:89%;">
      <p style="margin:0;"><strong>Son:</strong> ${totalTexto.toUpperCase()} D&Oacute;LARES</p>
      <p style="text-align:center; margin:5px 0 0;">******************************************************</p>
    </div>

    <h4 style="color:red; margin:10px auto 5px; width:90%;"><strong>Empresas Notificadas:</strong></h4>
    <ol style="margin:0 auto; padding-left:20px; width:90%; color:#000000;">
      ${listaEmpresas}
    </ol>
    <p style="color:#000000;">Saludos,<br>Jairo Vargas<br>6355 NW 36 St Ste 507<br>Virginia Gardens, FL. 33166</p>
  `;
}







  // 🔹 2. Funciones que corren al cargar
$(document).ready(function () {
    labelTotalSociedades();
    labelSociedadesActivas();
    labelSociedadesInactivas();
    labelSociedadesCorreoEnviado();
    if (!CKEDITOR.instances['mensaje']) {
      CKEDITOR.replace('mensaje', {
		  allowedContent: true,
		  entities: false		  // permite contenido HTML con estilos
		});
    }

    const tabla = $('#tablaSociedades').DataTable({
      ajax: {
        url: "../controller/envioRenovacionController.php?ajax=1",
        dataSrc: "data"
      },
      columns: [
        { data: "id_solicitud" },
        { data: "nombre_completo" },
        { data: "sociedades" },
        { data: "total_sociedades" },
        {
          data: null,
          render: function () {
            return `<input type="text" class="form-control inputAnnual" value="1745">`;
          }
        },
        {
          data: null,
          render: function () {
            return `<button class="btn btn-sm btn-primary btnCorreo">Enviar Correo</button>`;
          }
		  
        },
		  { data: "emails", visible:false},        
		   { data: "estado_pais", visible:false}    
      ],
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      },
      responsive: true,
      autoWidth: false
    });
    const tablaSociedadesRenovacionEnviada = $('#tablaSociedadesRenovacionEnviada').DataTable({
      ajax: {
        url: "../controller/envioRenovacionController.php?RenovacionEnviada=1",
        dataSrc: "data"
      },
      columns: [
        { data: "id_solicitud" },
        { data: "nombre_completo" },
        { data: "sociedades" },
        { data: "total_sociedades" },
       
        
      ],
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      },
      responsive: true,
      autoWidth: false
    });

    const tablaInactivas = $('#tablaSociedadesInactivas').DataTable({
      ajax: {
        url: "../controller/envioRenovacionController.php?tablaInactivas=1",
        dataSrc: "data"
      },
      columns: [
        { data: "id_solicitud" },
        { data: "nombre_completo" },
        { data: "sociedades" },
        { data: "total_sociedades" },     
       
      ],
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      },
      responsive: true,
      autoWidth: false
    });

$('#tablaSociedades').on('click', '.btnCorreo', async function () {
  const fila = $(this).closest('tr');
  const data = $('#tablaSociedades').DataTable().row(fila).data();
  const idSolicitud = data.id_solicitud;

  // ? Captura del valor actual del input Annual Report
  const valorAnnualReport = parseFloat(fila.find('.inputAnnual').val()) || 0;

  $.ajax({
    url: '../controller/envioRenovacionController.php?multiples=1&id_solicitud=' + idSolicitud,
    method: 'GET',
    dataType: 'json',
    success: async function (response) {
      const sociedadesMultiplesEstados = response.sociedades || [];

      const estados = (data.estado_pais || "")
        .split(',')
        .map(e => e.trim())
        .filter(e => e.length > 0);

      // ? Si NO hay sociedades m��ltiples �� usar generarCorreoHTML
      if (sociedadesMultiplesEstados.length === 0) {
        const htmlCorreo = generarCorreoHTML(data, valorAnnualReport, []);
        $('input[name="correo_destino"]').val(data.emails);

        // Validar instancia CKEditor antes de usarla
        if (!CKEDITOR.instances['mensaje']) {
          CKEDITOR.replace('mensaje');
        }

        CKEDITOR.instances['mensaje'].setData(htmlCorreo);
        $('#formCorreo').data('id', idSolicitud);
        $('#modalCorreo').modal('show');
        return;
      }

      // ? Si S�� hay sociedades m��ltiples �� mostrar SweetAlert por estado
		let formHtml = '<form id="formEstados">';

		// Campo fijo para ANNUAL REPORT base
		formHtml += `
		  <div class="form-group" style="text-align:left">
			<label for="annual_report_base">ANNUAL REPORT - BASE:</label>
			<input type="number" min="0" step="1" class="form-control" id="annual_report_base" name="ANNUAL_REPORT_BASE" value="${valorAnnualReport}">
		  </div>`;

		// Campos din��micos por estado
		estados.forEach((estado, i) => {
		  formHtml += `
			<div class="form-group" style="text-align:left">
			  <label for="estado_${i}">${estado}:</label>
			  <input type="number" min="0" step="1" class="form-control" id="estado_${i}" name="${estado}" value="${valorAnnualReport}">
			</div>`;
		});
		formHtml += '</form>';

		const result = await Swal.fire({
		  title: 'Valores por Estado (ANNUAL REPORT)',
		  html: formHtml,
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar',
		  showCancelButton: true,
		  focusConfirm: false,
		  preConfirm: () => {
			const inputs = document.querySelectorAll('#formEstados input');
			const valores = {};
			inputs.forEach(input => {
			  const estado = input.name;
			  valores[estado] = parseFloat(input.value) || 0;
			});
			return valores;
		  }
		});

		if (!result.isConfirmed) return;

		const valoresEstado = result.value;
		
		const cantidadPorEstado = await labelEstadosSociedades(data);

		// ?? Generar y mostrar correo usando los valores ingresados
		const htmlCorreo = generarCorreoConEstadosHTML(
		  data,
		  valoresEstado,
		  sociedadesMultiplesEstados,
		  valoresEstado['ANNUAL_REPORT_BASE'],
		  cantidadPorEstado
		);

      $('input[name="correo_destino"]').val(data.emails);

      // Validar instancia CKEditor antes de usarla
      if (!CKEDITOR.instances['mensaje']) {
        CKEDITOR.replace('mensaje');
      }

      CKEDITOR.instances['mensaje'].setData(htmlCorreo);
      $('#formCorreo').data('id', idSolicitud);
      $('#modalCorreo').modal('show');
    },
    error: () => Swal.fire('Error', 'No se pudieron cargar las sociedades m��ltiples.', 'error')
  });
});
       

	$('#formCorreo').on('submit', function (e) {
		  e.preventDefault();

		  const idSolicitud = $(this).data('id'); // ID de la solicitud (se guardó al hacer clic en "Enviar correo")
		  const correoDestino = $('input[name="correo_destino"]').val(); // Campo PARA:
		  const asunto = $('input[name="asunto"]').val(); // Campo ASUNTO:
		  const mensaje = CKEDITOR.instances['mensaje'].getData(); // Contenido del CKEditor (mensaje)

		  $.ajax({
			url: '../controller/envioRenovacionController.php?update=1',
			method: 'POST',
			data: {
			  id_solicitud: idSolicitud,
			  correo_destino: correoDestino,
			  asunto: asunto,
			  mensaje: mensaje
			},
			success: function (resp) {
			  console.log('Respuesta del backend:', resp);
			  const response = JSON.parse(resp);

			  if (response.success) {
				Swal.fire('Enviado', 'Correo enviado y estado actualizado.', 'success');
				tabla.ajax.reload(null, false);
				labelTotalSociedades();
				labelSociedadesActivas();
				labelSociedadesInactivas();
				labelSociedadesCorreoEnviado();
				$('#modalCorreo').modal('hide');
			  } else {
				Swal.fire('Error', response.error || 'No se pudo enviar el correo.', 'error');
			  }
			},
			error: function () {
			  Swal.fire('Error', 'No se pudo comunicar con el servidor.', 'error');
			}
		  });
	});

    // Consulta total sociedades externas
   
  });

function labelTotalSociedades() {
  console.log('�?ejecutar AJAX');
  $.ajax({
    url:'../controller/envioRenovacionController.php?total=1',
    method: 'GET',
    dataType: 'json', // asegura que siempre sea objeto JS
    success: function (data) {
      console.log('�?RESPUESTA AJAX:', data);
      if (data.total !== undefined) {
        $('#totalSociedades').text(data.total);
      } else {
        console.warn('Propiedad "total" no encontrada en:', data);
        $('#totalSociedades').text('Error');
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX error:', error);
      $('#totalSociedades').text('Error');
    }
  });
}

function labelSociedadesActivas() {
  $.ajax({
    url:'../controller/envioRenovacionController.php?activas=1',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      if (data.total !== undefined) {
        $('#totalActivas').text(data.total);
      } else {
        $('#totalActivas').text('Error');
      }
    },
    error: function () {
      $('#totalActivas').text('Error');
    }
  });
}

function labelSociedadesInactivas() {
  $.ajax({
    url:'../controller/envioRenovacionController.php?inactivas=1',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      if (data.total !== undefined) {
        $('#totalInactivas').text(data.total);
      } else {
        $('#totalInactivas').text('Error');
      }
    },
    error: function () {
      $('#totalInactivas').text('Error');
    }
  });
}

function labelSociedadesCorreoEnviado() {
  $.ajax({
    url:'../controller/envioRenovacionController.php?correoEnviado=1',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      if (data.total !== undefined) {
        $('#totalCorreoEnviado').text(data.total);
      } else {
        $('#totalCorreoEnviado').text('Error');
      }
    },
    error: function () {
      $('#totalCorreoEnviado').text('Error');
    }
  });
}
</script>


</body>
</html>
