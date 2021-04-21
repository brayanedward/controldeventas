<script type="text/javascript">
  $(document).ready( function () {
        $("#txtFechaDesde").datepicker({
          format : 'dd-mm-yyyy',
          autoclose:true,
          locale: 'es'
      });

        $("#txtFechaHasta").datepicker({
            format : 'dd-mm-yyyy',
            autoclose:true,
            locale:'es'
        });
  });

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
                                  <input type="input" id="txtFechaDesde" name="txtFechaDesde" class="form-control" placeholder="Ej: 30/07/2016" aria-invalid="false" value="<?php echo date('d-m-Y');?>">
                              </div>

                              <div class="form-group col-md-2">
                                <label for="tipoUsuario">FECHA HASTA</label>
                                  <input type="input" id="txtFechaHasta" name="txtFechaHasta" class="form-control" placeholder="Ej: 30/07/2016" aria-invalid="false" value="<?php echo date('d-m-Y');?>">
                              </div>

                              <div class="form-group col-md-2">
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
                                       <?php if($rows2['id_tipousuario']==3){?>
                                         <option value="<?php echo $rows2['id_tipousuario']?>" selected><?php echo $rows2['descripcion_tipousuario']?></option>
                                       <?php } else{ ?>
                                         <option value="<?php echo $rows2['id_tipousuario']?>"><?php echo $rows2['descripcion_tipousuario']?></option>
                                       <?php } endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                  <label for="tipoPago">TIPO PAGO</label>
                                    <select class="form-control" id="tipoPago" name="tipoPago">
                                      <option value="0">SELECCIONE TIPO PAGO</option>
                                      <option value="4" selected>TODOS</option>
                                      <?php foreach ($this->modelTipoPago->lista() as $rows3):?>
                                         <option value="<?php echo $rows3['id_tipopago']?>"><?php echo $rows3['descripcion_tipopago']?></option>
                                       <?php endforeach;?>
                                    </select>
                                </div>
                                <br>
                                <button type="button" class="btn btn-danger btn-round btnSearch">
                                    Buscar
                                </button>
                              <!-- <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-warning btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="table-rep-plugin">
                            <div class="table-wrapper">
                                <div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
                                    <br>
                                    <table id="datatable" class="table table-striped mb-0">
                                        <thead>

                                            <tr>
                                                <th id="tech-companies-1-col-0-clone">Código Venta</th>
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">Fecha Venta</th>
                                                <th data-priority="3" id="tech-companies-1-col-2-clone">Vendedor</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Rut Cliente Premium</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Nombre Cliente Premium</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Correo Cliente Premium</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Tipo de Pago</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Valor Venta</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Cupón</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Váucher</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Rut Invitado</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Nombre Invitado</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone">Correo Invitado</th>


                                            </tr>
                                        </thead>
                                        <tbody id="tbodyClientes">
                                            <?php $o = 0;
                                            foreach ($this->modelVenta->lista() as $rows) :
                                              $valorVenta = number_format($rows['valor_venta']);
                                              $valorVentaF =str_ireplace(',','.',$valorVenta);
                                              ?>

                                                <tr>
                                                    <th data-org-colspan="1" data-columns="tech-companies-1-col-0"><span class="co-name"><?php echo $rows['id_venta']; ?></span></th>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['fechaUsuario_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['nombre_usuario']); ?> <?php echo strtoupper($rows['apellido_usuario']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['rutCliente_venta']); ?>-<?php echo strtoupper($rows['dvCliente_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['nombreCliente_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo strtoupper($rows['correoCliente_venta']); ?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-1"><?php echo $rows['descripcion_tipopago'];?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5">$<?php echo $valorVentaF;?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5"><?php echo $rows['cupon_venta'];?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5"><?php echo $rows['vaucher_venta'];?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5"><?php echo $rows['rutInvitado_venta'];?>-<?php echo $rows['dvInvitado_venta'];?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5"><?php echo $rows['nombreInvitado_venta'];?></td>
                                                    <td data-org-colspan="1" data-priority="1" data-columns="tech-companies-1-col-5"><?php echo $rows['correoInvitado_venta'];?></td>

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


    <script type="text/javascript">

        $(document).ready( function () {
                $('#datatable').DataTable({
                     "language": {
                                "lengthMenu": "Mostrar _MENU_ ventas",
                                "zeroRecords": "Venta No Encontrada",
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
                            ordering:false,
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'excel'
                            ],
                            refresh:true


                });

              $("#txtFechaDesde").datetimepicker({
                  format : 'dd/mm/yyyy hh:ii',
                  autoclose:true,
                  locale: 'es'
              });

              $("#txtFechaHasta").datetimepicker({
                  format : 'dd/mm/yyyy hh:ii',
                  autoclose:true,
                  locale:'es'
              });

    } );



$("body").on('click','button.btnSearch', function(event) {

            $.ajax({
                data: {
                  "txtFechaDesde": $("#txtFechaDesde").val(),
                  "txtFechaHasta": $("#txtFechaHasta").val(),
                  "tipoUsuario"  : $("#tipoUsuario").val(),
                  "tipoPago"     : $("#tipoPago").val(),
                  "usuario"      : $("#usuario").val()
                },
                url: "<?php echo $this->listaxfiltro; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                  alertify.success('Buscando ...');

                },
                success: function(respuesta) {

                    alertify.success('Listo!');
          
                    $('#datatable').DataTable().destroy();
                    $('#tbodyClientes').html(respuesta);
                    $('#datatable').DataTable({
                         "language": {
                                    "lengthMenu": "Mostrar _MENU_ ventas",
                                    "zeroRecords": "Venta No Encontrada",
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
                                ordering:false,
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                refresh:true


                    });


                }
            });
            return false;
        });

    </script>
