<script type="text/javascript">
</script>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Lista de Ventas </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Ventas</a>
                            </li>
                            <li class="active">
                                Lista de Ventas
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
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">ID</th>
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">Fecha</th>
                                                <th data-priority="3" id="tech-companies-1-col-2-clone">Vendedor</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Rut Premium</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Cliente Premium</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Invitado</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Fin Membresía</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $o = 0;
                                            foreach ($this->model->lista() as $rows) :
                                              if($rows['rutInvitado_venta']){
                                                $msjInvitado = 'Si';
                                              }else{
                                                $msjInvitado = 'No';
                                              }

                                              ?>

                                                <tr>
                                                    <th data-org-colspan="1" data-columns="tech-companies-1-col-0"><span class="co-name"><?php echo $rows['id_venta'];?></span></th>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['fechaUsuario_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['nombre_usuario']); ?> <?php echo strtoupper($rows['apellido_usuario']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $rows['rutCliente_venta']; ?>-<?php echo $rows['dvCliente_venta']; ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $rows['nombreCliente_venta']; ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $msjInvitado; ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1">COMPLETAR</td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5">

                                                        <span class="hint  hint--left iconVenta" data-hint="Ver Reporte" attr-idventa="<?php echo $rows['id_venta'] ?>">
                                                            <a class="btn btn-icon waves-effect waves-light btn-warning">
                                                                <i style="cursor: pointer;" class="mdi mdi-eye "></i>
                                                            </a>
                                                        </span>


                                                        <span class="hint  hint--left" data-hint="Editar Venta">
                                                            <a class="btn btn-icon waves-effect waves-light btn-primary" href="<?php echo $this->urledit . base64_encode($rows['id_venta']); ?>">
                                                                <i style="cursor: pointer;" class="mdi mdi-pen " id="iconHistorial"></i>
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


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalInfoVenta">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">INFORMACIÓN DETALLADA DE LA VENTA</h4>
                    </div>
                    <div class="modal-body" id="contenidoInfoVenta">

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
                            },
                            ordering:false

                });
            } );


       $("body").on('click','span.iconVenta', function(event) {
            $('#contenidoInfoVenta').empty('');
            var idventa = $(this).attr('attr-idventa');
            $('#modalInfoVenta').modal('show');
            $.ajax({
                data: {
                    "idventa": idventa
                },
                url: "<?php echo $this->infoventa; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                },
                success: function(respuesta) {
                  console.log(respuesta);
                    $('#contenidoInfoVenta').html(respuesta);

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
