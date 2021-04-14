<script type="text/javascript">
</script>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Lista de Clientes </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Lista de Clientes</a>
                            </li>
                            <li class="active">
                                Lista de Clientes
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="table-rep-plugin">
                            <div class="table-wrapper">
                                <div class="btn-toolbar">
                                    <a href="./view.php?c=venta&a=add" class="btn btn-info waves-effect waves-light mb-3" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a">
                                        <i class="md md-add"></i> Agregar Venta</a>
                                </div>
                                <div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
                                    <br>
                                    <table id="datatable" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th id="tech-companies-1-col-0-clone">Rut</th>
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">ID</th>
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">Fecha</th>
                                                <th data-priority="3" id="tech-companies-1-col-2-clone">Vendedor</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Cliente</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Valor</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $o = 0;
                                            foreach ($this->model->lista() as $rows) : ?>

                                                <tr>
                                                    <th data-org-colspan="1" data-columns="tech-companies-1-col-0"><span class="co-name"><?php echo $rows['id_venta']; ?>-<?php echo $rows['dv_cliente']; ?></span></th>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['fechaUsuario_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['fechaUsuario_venta']); ?> <?php echo strtoupper($rows['apellidom_cliente']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $rows['fechaUsuario_venta']; ?> <b>año(s)</b> <?php echo $rows['meses_actual'];?><b> Mes(es)</b> <?php echo $rows['dias_actual']; ?> <b>día(s)</b></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $alert;?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5">

                                                        <span class="hint  hint--left iconPerfil" data-hint="Ver Reporte" attr-rut="<?php echo $rows['id_venta'] ?>">
                                                            <a class="btn btn-icon waves-effect waves-light btn-warning">
                                                                <i style="cursor: pointer;" class="mdi mdi-eye "></i>
                                                            </a>
                                                        </span>

                                                </tr>
                                            <?php $o++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
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
