<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-rF4FfzFvISvfjjkC9vHjHvWvexw9CGZ4VZxLb5+RUuN/6ZQQH80CswgU2gBMAeI8" crossorigin="anonymous"> -->


<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/dist/css/adminlte.css">
<!-- <link rel="stylesheet" href="../resource/AdminLTE-3.2.0/dist/css/adminlte.min.css"> -->
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/dist/css/bootstrap.css">


<!-- dataTable -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="../resource/AdminLTE-3.2.0/dist/css/botones.css">

<!-- select2 -->
<link rel="stylesheet" href="../resource/AdminLTE-3.2.0/plugins/select2/css/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- scrip del sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<link rel="stylesheet" href="./css/menu-custom.css?v=1.1">

<!-- /****************
TRIAGE crear CASO
*****************/ -->
<!-- <script>
    var opciones = {

        "Código azul": ["Compromiso hemodinámica severo", "Alta", "15 min"],
        "Emergencia": ["Compromiso hemodinámica moderado", "Alta", "30 min"],
        "Urgencia": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgercia obstétrica": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgencia UCI": ["Sin compromiso de estado hemodinámica pero requiere atención en UCI", "Media", "60 min"],
        "Prioritario": ["Sin compromiso de estado hemodinámica o general a riesgo de complicaciones si no recibe atención", "Baja", "120 min"]
    }



    function cambioOpciones()

    {
        var combo = document.getElementById('clasificacionTriage');
        var opcion = combo.value;


        document.getElementById('tipoPacienteTriage').value = opciones[opcion][0];

        document.getElementById('clasificacionGravedadTriage').value = opciones[opcion][1];

        document.getElementById('tiempoAtencionTriage').value = opciones[opcion][2];


        


    }
</script> -->

<!-- /****************
TRIAGE SEGUIMIENTO CASO
*****************/ -->
<!-- <script>
    var opciones = {

        "Código azul": ["Compromiso hemodinámica severo", "Alta", "15 min"],
        "Emergencia": ["Compromiso hemodinámica moderado", "Alta", "30 min"],
        "Urgencia": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgercia obstétrica": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgencia UCI": ["Sin compromiso de estado hemodinámica pero requiere atención en UCI", "Media", "60 min"],
        "Prioritario": ["Sin compromiso de estado hemodinámica o general a riesgo de complicaciones si no recibe atención", "Baja", "120 min"],
        "Diferido": ["Diferido", "Ninguna", "0 min"]
    }


    var opciones2 = {

        "Código azul": ["Compromiso hemodinámica severo", "Alta", "15 min"],
        "Emergencia": ["Compromiso hemodinámica moderado", "Alta", "30 min"],
        "Urgencia": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgercia obstétrica": ["Sin compromiso de estado hemodinámica pero requiere atención pronta", "Media", "60 min"],
        "Urgencia UCI": ["Sin compromiso de estado hemodinámica pero requiere atención en UCI", "Media", "60 min"],
        "Prioritario": ["Sin compromiso de estado hemodinámica o general a riesgo de complicaciones si no recibe atención", "Baja", "120 min"],
        "Diferido": ["Diferido", "Ninguna", "0 min"]
    }

    function cambioOpciones1()

    {
        var combo = document.getElementById('seguimientoTriageComentarioIps');
        var opcion = combo.value;

        //document.getElementById('seguimientoTiempoObervadoTriageComentariosIps').value = opciones[opcion][0];

        document.getElementById('seguimientoGravedadTriageComentarioIps').value = opciones[opcion][1];

        document.getElementById('seguimientoTiempoAtencionTriageComentarioIps').value = opciones[opcion][2];


        var combo2 = document.getElementById('seguimientoTriageComentarioIps');
        var opcion2 = combo2.value;

        //document.getElementById('seguimientoTiempoObervadoTriageComentariosIps').value = opciones[opcion][0];

        document.getElementById('seguimientoGravedadTriageComentarioIps2').value = opciones2[opcion2][1];

        document.getElementById('seguimientoTiempoAtencionTriageComentarioIps2').value = opciones2[opcion2][2];

    }
</script> -->

    <!-- <script>
        function buscarPacienteCronico() {
            //el input donde se esta escribiendo la cedula
            var valorBusquedaCronico = $("input#numero_documento").val();
            // se valida si no esta vacio que envie por post 
            // el valorBusqueda es el nombre con que se envia al post $_POST['valorBusqueda'];
            // la respuesta es lo que se recibe del print_r o echo y se muestra en el input 

            var datos = new FormData();
            datos.append('idPaciente', valorBusquedaCronico);
            if (valorBusquedaCronico != "") { 
                $.ajax({
                    url:'verificar_identificacion_paciente_cronico.php',
                    method:'POST',
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (resp) {
                        console.log(resp);
                        if(resp!=""){
                            for (let item of resp) {
                                console.log(item.nombres); 
                                $('#ciudad_agenda').val(item.ciudad_agenda);
                                $('#ciudad_agenda').append(item.ciudad_agenda).trigger('change');
                                $('#nombres').val(item.nombres);
                                $('#apellidos').val(item.apellidos);
                                $('#edad').val(item.edad);
                                $('#intervalo_edad').val(item.intervalo_edad);
                                $('#telefono').val(item.telefono);
                                $('#celular').val(item.celular);
                                $('#email').val(item.email);
                                $('#eps_agenda').val(item.eps);
                                $('#eps_agenda').append(item.eps).trigger('change');
                            }
                        }else{
                            $('#ciudad_agenda').val('');
                            $('#ciudad_agenda').append('').trigger('change');
                            $('#nombres').val('');
                            $('#apellidos').val('');
                            $('#edad').val('');
                            $('#intervalo_edad').val('');
                            $('#telefono').val('');
                            $('#celular').val('');
                            $('#email').val('');
                            $('#eps_agenda').val('');
                            $('#eps_agenda').append('').trigger('change');
                        }
                        // for(item in json){
                        //         console.log(json[item].nombres);
                        //     }
                        // if(resp != ""){
                        //     alert('Paciente no encontrado');
                        // }else{
                            
                        // }
                    }
                });

                // $.post("verificar_identificacion_paciente.php", {
                //     valorBusquedaCronico: textoBusqueda
                // }, function(respuesta) {
                //     console.log(respuesta);
                //     $("#datosPacienteCronico").html(respuesta);
                // });
            
            }else{

            }
        }

    </script> -->


<!-- <script>
    function buscar() {
        //el input donde se esta escribiendo la cedula
        var textoBusqueda = $("input#numeroIdentificacionPaciente").val();

        // se valida si no esta vacio que envie por post 
        // el valorBusqueda es el nombre con que se envia al post $_POST['valorBusqueda'];
        // la respuesta es lo que se recibe del print_r o echo y se muestra en el input 
        if (textoBusqueda != "") {
            $.post("verificar_identificacion_paciente.php", {
                valorBusqueda: textoBusqueda
            }, function(respuesta) {
                var resp = JSON.parse(respuesta);

                if(resp[1]=='Activo' || resp[1]=='Ubicado'){
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Este paciente ya tiene una referenciar registrada',
                    //     confirmButtonColor: '#3085d6',
                    // })
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                        title: 'Este usuario ya tiene un caso '+resp[1],
                        text: "Desea continuar con el registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                        reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // swalWithBootstrapButtons.fire(
                                // 'Deleted!',
                                // 'Your file has been deleted.',
                                // 'success'
                                // )
                            }else if (result.dismiss === Swal.DismissReason.cancel) {
                                $('#numeroIdentificacionPaciente').val('');
                                $("#primerNombrePaciente").val('');
                                $("#segundoNombrePaciente").val('');
                                $("#primerApellidoPaciente").val('');
                                $("#segundoApellidoPaciente").val('');
                                $("#generoPaciente").val('');
                                $("#fechaNacimientoPaciente").val('');
                                $("#edadPaciente").val('');
                                $("#telefonoPaciente").val('');
                                $("#estadoCivilPaciente").val('');
                                $("#ocupacionPaciente").val('');
                                $("#correoPaciente").val('');
                                $("#municipioPaciente").val('');
                                $("#codigoMunicipioPaciente").val('');
                                $("#tipoLocalidad").val('');
                                $("#seguridadSocialPaciente").val('');
                                $("#otraSeguridadSocialPaciente").val('');
                                $("#tieneEpsPaciente").val('');
                                $("#nombreEpsPaciente").val('');
                                $("#codigoEpsPaciente").val('');
                                $("#tieneIpsPaciente").val('');
                                $("#nombreIpsPaciente").val('');
                                $("#codigoIpsPaciente").val('');
                                $("#migracion").val('');
                                $("#nombreLugarCapitaPaciente").val('');
                                $("#codigoLugarCapitaPaciente").val('');
                                                    
                            }
                        })
                }

                console.log(resp[0]);


                $("#aqui").html(resp[0]);


            });
        } else {
            $("#primerNombrePaciente").val('');
            $("#segundoNombrePaciente").val('');
            $("#primerApellidoPaciente").val('');
            $("#segundoApellidoPaciente").val('');
            $("#generoPaciente").val('');
            $("#fechaNacimientoPaciente").val('');
            $("#edadPaciente").val('');
            $("#telefonoPaciente").val('');
            $("#estadoCivilPaciente").val('');
            $("#ocupacionPaciente").val('');
            $("#correoPaciente").val('');
            $("#municipioPaciente").val('');
            $("#codigoMunicipioPaciente").val('');
            $("#tipoLocalidad").val('');
            $("#seguridadSocialPaciente").val('');
            $("#otraSeguridadSocialPaciente").val('');
            $("#tieneEpsPaciente").val('');
            $("#nombreEpsPaciente").val('');
            $("#codigoEpsPaciente").val('');
            $("#tieneIpsPaciente").val('');
            $("#nombreIpsPaciente").val('');
            $("#codigoIpsPaciente").val('');
            $("#migracion").val('');
            $("#nombreLugarCapitaPaciente").val('');
            $("#codigoLugarCapitaPaciente").val('');
        };
    };
</script> -->
