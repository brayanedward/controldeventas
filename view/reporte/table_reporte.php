
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
                                Generar Reportes
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
                              <div class="form-group col-md-2">
                                <label for="tipoUsuario">FECHA DESDE</label>
                                  <input type="date" id="txtFechaDesde" name="txtFechaDesde" class="form-control datepicker valid" placeholder="Ej: 30/07/2016" aria-invalid="false" value="<?php echo date('d-m-Y');?>">
                              </div>

                              <div class="form-group col-md-2">
                                <label for="tipoUsuario">FECHA HASTA</label>
                                  <input type="date" id="txtFechaHasta" name="txtFechaHasta" class="form-control datepicker valid" placeholder="Ej: 30/07/2016" aria-invalid="false" value="<?php echo date('d-m-Y');?>">
                              </div>

                              <div class="form-group col-md-3">
                                <label for="usuario">VENDEDOR</label>
                                  <select class="form-control" id="usuario" name="usuario">
                                    <option value="0">SELECCIONE VENDEDOR</option>
                                    <option value="3" selected>TODOS</option>
                                    <?php foreach ($this->modelUsuario->lista() as $rows4):?>
                                       <option value="<?php echo $rows4['rut_usuario']?>"><?php echo $rows4['nombre_usuario']?> <?php echo $rows4['apellido_usuario']?></option>
                                     <?php endforeach;?>
                                  </select>
                              </div>

                                <div class="form-group col-md-2">
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

                                <div class="form-group col-md-2">
                                  <label for="tipoPago">TIPO PAGO</label>
                                    <select class="form-control" id="tipoPago" name="tipoPago">
                                      <option value="0">SELECCIONE TIPO PAGO</option>
                                      <option value="3" selected>TODOS</option>
                                      <?php foreach ($this->modelTipoPago->lista() as $rows3):?>
                                         <option value="<?php echo $rows3['id_tipoPago']?>"><?php echo $rows3['descripcion_tipoPago']?></option>
                                       <?php endforeach;?>
                                    </select>
                                </div>
                                <br>
                                <button type="button" class="btn btn-danger btn-round btnPdf">Generar PDF</button>
                                <button type="button" class="btn btn-success btn-round btnExcel">Generar Excel</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-warning btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- content -->

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


        $("body").on('click','button.btnPdf', function(event) {
            //var rutCliente = $(this).attr('attr-rut');
            $.ajax({
                data: {
                    "txtFechaDesde": txtFechaDesde,
                    "txtFechaHasta": txtFechaHasta,
                    "tipoUsuario"  : tipoUsuario,
                    "tipoPago"     : tipoPago,
                    "usuario"      : usuario
                },
                url: "<?php echo $this->generaPDF; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                },
                success: function(respuesta) {
                  //  $('#contenidoInfoCliente').html(respuesta);
                  alert("paso");
                },
                error: function(respuesta) {
                  //  $('#contenidoInfoCliente').html(respuesta);
                  alert("no paso");
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


    </script>
