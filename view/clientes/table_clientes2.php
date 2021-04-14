<script type="text/javascript">
</script>
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Buscar Clientes </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Buscar Clientes
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
                                <label for="selTipoBusq">Buscar Por</label>
                                <select id="selTipoBusq" name="selTipoBusq" class="form-control valid" required="" aria-invalid="false" style="width: 50%" onchange="compbusqueda()">
                                    <option>SELECCIONE ... </option>
                                    <option value="1">DIRECCION</option>
                                    <option value="2">RUT</option>
                                    <option value="3">NOMBRE</option>
                                </select>
                                <div id="buscaDireccion" style="display: none;">
                                    <label for="direccion">Ingrese Dirección</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" style="width: 40%">
                                    N° <input type="text" name="direccionnum" id="direccionnum" class="form-control" autocomplete="off" style="width: 20%">
                                </div>
                                <div id="buscaRut" style="display: none;">
                                    <label for="rut">Ingrese Rut</label>
                                    <input type="text" name="rut" id="rut" class="form-control" autocomplete="off" style="width: 30%">
                                </div>
                                <div id="buscaNombre" style="display: none;">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" autocomplete="off">
                                    <label for="nombre">Apellido P.</label> <input type="text" name="apellidop" id="apellidop" class="form-control" autocomplete="off">
                                    <label for="nombre">Apellido M.</label> <input type="text" name="apellidom" id="apellidom" class="form-control" autocomplete="off">
                                </div>
                                <br>
                                <button style="margin-left:10px;display:none;" id="Buscar" type="submit" onclick="buscar()" class="btn btn-info btn-round btnSave"><i class="zmdi zmdi-zoom-in"></i> Buscar</button>
                                <div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns" id="resultbusq" style="display: none;">
                                    <br>
                                    <table id="tech-companies-1" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th id="tech-companies-1-col-0-clone">Rut</th>
                                                <th data-priority="1" id="tech-companies-1-col-1-clone">Nombres</th>
                                                <th data-priority="3" id="tech-companies-1-col-2-clone">Apellido Paterno</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Apellido Materno</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Dirección</th>
                                                <th data-priority="1" id="tech-companies-1-col-3-clone">Telefono</th>
                                                <th data-priority="3" id="tech-companies-1-col-5-clone"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyClientes">

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
                                <textarea class="form-control sinclase" name="txtindivisita" id="txtindivisita" cols="55" rows="5" maxlength="1000"></textarea>
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
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="timeline timeline-left" id="cargaHistorial">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        $("body").on('click', 'span.iconPerfil', function(event) {
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
                beforeSend: function() {},
                success: function(respuesta) {
                    $('#contenidoInfoCliente').html(respuesta);

                }
            });
            return false;

        });

        $('.sinclase').maxlength({
            alwaysShow: true,
            threshold: 10,
            warningClass: "label label-success",
            limitReachedClass: "label label-danger",
            placement: 'bottom',
            separator: ' / '
        });

        $('input#rut').Rut({
            on_error: function() {
                $('button[type="submit"]').attr("disabled", true);
                $('button.btnSave').html('Ops! Rut incorrecto');
            },
            on_success: function() {
                $('button[type="submit"]').attr("disabled", false);
                $('button.btnSave').html('Buscar');
            },
            format_on: 'keyup'
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

        function realizarVisita(rutcli) {
            $('#ModalVisita').modal();
            $("#btnGuardaVisita").attr("onclick", "guardaVisita(" + rutcli + ")");
        }

        function guardaVisita(rutcli) {
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

        function historilVisitas(rutcli) {
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

        function generaPDF(rutcli) {
            $.ajax({
                data: {
                    "rutcli": rutcli
                },
                url: "<?php echo $this->generaPDF; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {

                }
            });
            return false;
        }
    </script>