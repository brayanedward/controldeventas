
<script type="text/javascript">
  $( function() {
    jQuery('#txtFechaHasta').datepicker();
    jQuery('#txtFechaDesde').datepicker();
  } );
  </script>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Reportes </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Reportes</a>
                            </li>
                            <li class="active">
                                Generación de Reportes
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="body">
                            <form class="form" id="form" method="POST">
                              <div class="form-group col-md-3">
                                <label for="tipoUsuario">FECHA DESDE</label>
                                  <input type="date" id="txtFechaDesde" name="txtFechaDesde" class="form-control datepicker valid" placeholder="Ej: 30/07/2016" aria-invalid="false">
                              </div>

                              <div class="form-group col-md-3">
                                <label for="tipoUsuario">FECHA HASTA</label>
                                  <input type="date" id="txtFechaHasta" name="txtFechaHasta" class="form-control datepicker valid" placeholder="Ej: 30/07/2016" aria-invalid="false">
                              </div>

                                <div class="form-group col-md-3">
                                  <label for="tipoUsuario">TIPO USUARIO</label>
                                    <select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                      <option value="0">SELECCIONE TIPO USUARIO</option>
                                      <option value="3" selected>TODOS</option>
                                      <?php foreach ($this->modelTipoUsuario->lista() as $rows2):?>
                                       <?php if($rows2['id_tipoUsuario']==3){?>
                                         <option value="<?php echo $rows2['id_tipoUsuario']?>" selected><?php echo $rows2['descripcion_tipoUsuario']?></option>
                                       <?php } else{ ?>
                                         <option value="<?php echo $rows2['id_tipoUsuario']?>"><?php echo $rows2['descripcion_tipoUsuario']?></option>
                                       <?php } endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                  <label for="tipoUsuario">TIPO PAGO</label>
                                    <select class="form-control" id="tipoUsuario" name="tipoUsuario">
                                      <option value="0">SELECCIONE TIPO PAGO</option>
                                      <option value="3" selected>TODOS</option>
                                      <?php foreach ($this->modelTipoPago->lista() as $rows3):?>
                                         <option value="<?php echo $rows3['id_tipoPago']?>"><?php echo $rows3['descripcion_tipoPago']?></option>
                                       <?php endforeach;?>
                                    </select>
                                </div>
                                <br>
                                <button type="button" onclick="editar(<?php echo $rows['rut_usuario']?>)" class="btn btn-danger btn-round">Generar PDF</button>
                                <button type="button" onclick="editar(<?php echo $rows['rut_usuario']?>)" class="btn btn-success btn-round">Generar Excel</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-warning btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- content -->

    </div>

        <!-- Modal -->
    <div class="modal fade" id="ModalVisita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realizar Nueva Visita</h5>
                </div>
                <div class="modal-body">
                    <table class="">
                        <tr>
                            <td>
                                Indique Fecha Visita:
                            </td>
                            <td>
                                <input type="date" id="txtfechavisita" name="txtfechavisita" class="form-control datepicker valid" placeholder="Ej: 30/07/2016" aria-invalid="false">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Indique Descripcion Visita:
                            </td>
                            <td>
                                <textarea class="form-control" name="txtindivisita" id="txtindivisita" cols="55" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardaVisita">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalHistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" >
                <div class="col-sm-12">
                            <div class="timeline timeline-left" id="cargaHistorial">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardaVisita">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalInfoCliente">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">INFORMACIÓN DEL CLIENTE</h4>
                    </div>
                    <div class="modal-body" id="contenidoInfoCliente">

                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <script type="text/javascript">

        $(document).ready( function () {
                $('#datatable').DataTable({
                     "language": {
                                "lengthMenu": "Mostrar _MENU_ clientes",
                                "zeroRecords": "Cliente No Encontrado",
                                "info": "Página _PAGE_ de _PAGES_",
                                "infoEmpty": "Los datos buscados no existen en los registros",
                                "infoFiltered": "(Buscado entre los _MAX_ registros actuales)",
                                "search": "Buscar",
                                "paginate": {
                                                "first": "Primero",
                                                "last": "Ultimo",
                                                "next": "Siguiente",
                                                "previous": "Anterior"
                                            },
                                "loadingRecords": "Cargando...",
                            }

                });
            } );


        $("body").on('click','span.iconPerfil', function(event) {
            $('#contenidoInfoCliente').empty('');
            var rutCliente = $(this).attr('attr-rut');
            $('#modalInfoCliente').modal('show');
            $.ajax({
                data: {
                    "rutCliente": rutCliente
                },
                url: "<?php echo $this->infoCliente; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                },
                success: function(respuesta) {
                    $('#contenidoInfoCliente').html(respuesta);

                }
            });
            return false;

        });



        function compbusqueda() {
            $('#buscaDireccion').hide();
            $('#buscaRut').hide();
            $('#buscaNombre').hide();
            $('#Buscar').hide();
            $('button[type="submit"]').attr("disabled", false);
            $('button.btnSave').html('Buscar');

            if ($('#selTipoBusq').val() == 1) {
                $('#buscaDireccion').show();
                $('#Buscar').show();
                $('#rut').val('');
                $('#nombre').val('');
                $('#apellidop').val('');
                $('#apellidom').val('');
            }
            if ($('#selTipoBusq').val() == 2) {
                $('#buscaRut').show();
                $('#Buscar').show();
                $('#nombre').val('');
                $('#apellidop').val('');
                $('#apellidom').val('');
                $('#direccion').val('');
                $('#direccionnum').val('');
            }
            if ($('#selTipoBusq').val() == 3) {
                $('#buscaNombre').show();
                $('#Buscar').show();
                $('#direccion').val('');
                $('#direccionnum').val('');
                $('#rut').val('');
            }
        }

        function buscar() {
            var tipob = $('#selTipoBusq').val();
            var direccion = $('#direccion').val();
            var rut = $('#rut').val();
            var nombre = $('#nombre').val();
            var apellidop = $('#apellidop').val();
            var apellidom = $('#apellidom').val();
            var direccionnum = $('#direccionnum').val();

            $.ajax({
                data: {
                    "tipob": tipob,
                    "direccion": direccion,
                    "rut": rut,
                    "nombre": nombre,
                    "apellidop": apellidop,
                    "apellidom": apellidom,
                    "direccionnum": direccionnum
                },
                url: "<?php echo $this->listaxfiltro; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    $('#resultbusq').show();
                    $('#tbodyClientes').html(respuesta);
                }
            });
            return false;
        }

        function realizarVisita(rutcli){
            $('#ModalVisita').modal();
            $("#btnGuardaVisita").attr("onclick","guardaVisita("+rutcli+")");
        }

        function guardaVisita(rutcli){
            var txtindivisita = $('#txtindivisita').val();
            var txtfechavisita = $('#txtfechavisita').val();

            $.ajax({
                data: {
                    "txtindivisita": txtindivisita,
                    "txtfechavisita": txtfechavisita,
                    "rutcli": rutcli
                },
                url: "<?php echo $this->guardaVisita; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    if (respuesta == 1) {
                        alertify.success('Guardado Exitosamente!');
                        $('#ModalVisita').modal('hide');
                        $('#txtindivisita').val('');
                    } else {
                        alertify.error('Error al ingresar la información');
                    }
                }
            });
            return false;
        }

        function historilVisitas(rutcli){
            $('#ModalHistorial').modal();
            $('#cargaHistorial').empty();
            $.ajax({
                data: {
                    "rutcli": rutcli
                },
                url: "<?php echo $this->HistorialVisita; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    $('#cargaHistorial').html(respuesta);
                }
            });
            return false;
        }

    </script>
