<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Estados - Sociedades Activas</title>
    <?php include_once "head/head_views.php"; ?>
    
   

    <!-- amCharts -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

     <!-- Bootstrap 4 -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/bootstrap/css/bootstrap.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- jQuery -->
<script src="../resource/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../resource/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="../resource/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                
                <h3>Total Sociedades Por Estados</h3>

                <!-- Contadores -->
                <div class="row text-center mb-4">
                    <div class="col-md-4">
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

                    <div class="col-md-4">
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

                    <div class="col-md-4">
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
                </div>
                <div class="row" style="display: flex;">
					<!-- Mapa de Estados Unidos -->
					<div class="col-md-7">
						<div class="card">
							<div class="card-body">
								<div id="mapaEstados" style="width: 100%; height: 650px;"></div>
							</div>
						</div>
					</div>

					<!-- Tabla con DataTables -->
					<div class="col-md-5">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Sociedades por Estado</h3>
							</div>
							<div class="card-body" style="overflow-y: auto; height: 650px;">
								<table id="tablaSociedades" class="display nowrap table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>Nombre Sociedad</th>
											<th>Estados</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div> <!-- cierre de container-fluid -->
        </section> <!-- cierre de section.content -->
    </div> <!-- cierre de wrapper -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
	
	 // 🔹 Funciones AJAX para actualizar los contadores
        function labelTotalSociedades() {
            $.ajax({
                url: '../controller/envioRenovacionController.php?total=1',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#totalSociedades').text(data.total ?? '0');
                },
                error: function() {
                    $('#totalSociedades').text('Error');
                }
            });
        }

        function labelSociedadesActivas() {
            $.ajax({
                url: '../controller/envioRenovacionController.php?activas=1',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#totalActivas').text(data.total ?? '0');
                },
                error: function() {
                    $('#totalActivas').text('Error');
                }
            });
        }

        function labelSociedadesInactivas() {
            $.ajax({
                url: '../controller/envioRenovacionController.php?inactivas=1',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#totalInactivas').text(data.total ?? '0');
                },
                error: function() {
                    $('#totalInactivas').text('Error');
                }
            });
        }
        // 🔹 Función para cargar el mapa
          // 🔹 Función para cargar el mapa
        function cargarMapaEstados() {
    $.ajax({
        url: '../controller/reporteEstadosController.php?action=cargar_datos',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            am5.ready(function() {
                var root = am5.Root.new("mapaEstados");

                root.setThemes([am5themes_Animated.new(root)]);

               
                var chart = root.container.children.push(
                    am5map.MapChart.new(root, {
                        projection: am5map.geoAlbersUsa()
                    })
                );

               
                var polygonSeries = chart.series.push(
                    am5map.MapPolygonSeries.new(root, {
                        geoJSON: am5geodata_usaLow,
                        valueField: "value",
                        calculateAggregates: true
                    })
                );


                let totalSociedades = 0;

               
                response.forEach(function(item) {
                    if (item.id) {
                        polygonSeries.data.push({
                            id: item.id,
                            value: item.value
                        });
                        totalSociedades += parseInt(item.value);
                    }
                });

              
                var heatSeries = chart.series.push(
                    am5map.MapPointSeries.new(root, {
                        valueField: "value",
                        calculateAggregates: true
                    })
                );

                heatSeries.bullets.push(function(root, series, dataItem) {
                    var container = am5.Container.new(root, {});

                    //circulo
                    var circle = container.children.push(
                        am5.Circle.new(root, {
                            radius: Math.log(dataItem.get("value")) * 4.5, 
                            fill: am5.color(0xD32F2F), 
                            stroke: am5.color(0xFFFFFF), 
                            strokeWidth: 1.5,
                            opacity: 0.8
                        })
                    );

                    //  Etiqueta del estado
                    var label = container.children.push(
                        am5.Label.new(root, {
                            text: dataItem.get("value").toString(),
                            fontSize: 22,  // fuente
                            fontWeight: "bold",
                            centerX: am5.p50,
                            centerY: am5.p50,
                            fill: am5.color(0xFFFFFF), 
							paddingTop: 10,
							paddingBottom: 10,
							paddingLeft:10,//hector
							paddingRight:10
                        })
                    );

                    return am5.Bullet.new(root, {
                        sprite: container
                    });
                });

               
                response.forEach(function(item) {
                    heatSeries.data.push({
                        geometry: {
                            type: "Point",
                            coordinates: [item.longitude, item.latitude]
                        },
                        value: item.value
                    });
                });

            });
        },
        error: function() {
            console.error("No se pudieron cargar los datos del mapa.");
        }
    });
}


        // Función para cargar el DataTable
        function cargarTablaSociedades() {
            $('#tablaSociedades').DataTable({
                ajax: {
                    url: '../controller/reporteEstadosController.php?action=obtener_sociedad_estado',
                    dataSrc: ''
                },
                columns: [
                    { data: 'nombre_sociedad' },
                    { data: 'estado' }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar a PDF',
                        className: 'btn btn-danger'
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                }
            });
        }

        //  Cargar funciones al iniciar la vista
        $(document).ready(function() {
            labelTotalSociedades();
            labelSociedadesActivas();
            labelSociedadesInactivas();
            cargarMapaEstados();
			cargarTablaSociedades();
        });
    </script>

    <?php include_once "footer/footer_views.php"; ?>
</body>
</html>
