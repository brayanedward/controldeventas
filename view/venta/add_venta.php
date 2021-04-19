

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Registrar Ventas </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Registro de ventas
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet">
                        <div class="portlet-heading bg-info">
                            <h3 class="portlet-title">
                                DATOS VENTA
                            </h3>
                            <div class="portlet-widgets">
                                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#accordion1" href="#ventas"><i
                                        class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="ventas" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <div class="form-group col-lg-6">
                                    <label for="txtValorventa">Valor Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                        <input type="number" id="txtValorventa" name="txtValorventa"
                                            class="form-control" placeholder="" maxlength="9">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtFechaventa">Fecha Venta</label>
                                    <input type="datetime-local" id="txtFechaventa" name="txtFechaventa" class="form-control"
                                        placeholder="">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="txtNombrecventa">Nombres Cliente</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box-o"></i></span>
                                        <input type="text" id="txtNombrecventa" name="txtNombrecventa"
                                            class="form-control" placeholder="Ingrese los Nombres de Cliente"
                                            maxlength="500">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="txtDireccioventa">Dirección Venta</label>
                                    <input type="text" id="txtDireccioventa" name="txtDireccioventa"
                                        class="form-control" placeholder="Ingrese Direccion de la Venta"
                                        maxlength="500">
                                </div>
                                <br>
                                <div class="form-group col-lg-6">
                                    <label for="txtTelefonocliente">Teléfono Cliente </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                                        <input type="text" id="txtTelefonocliente" name="txtTelefonocliente"
                                            class="form-control" placeholder="Ingrese Telefono Cliente"
                                            maxlength="500">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="txtCorreocliente">Correo Cliente </label>
                                    <input type="text" id="txtCorreocliente" name="txtCorreocliente"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico"
                                        maxlength="500">
                                </div>
                                <br>
                                <label for="txtCorreoElectronico">Tipo de Pago</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-card"></i></span>
                                    <select id="selTipopago" name="selTipopago" class="form-control" required="">
                                        <option>SELECCIONE ... </option>
                                        <?php foreach ($this->model->listaPagos() as $rowPago) : ?>
                                        <option value="<?php echo $rowPago['id_tipopago'] ?>">
                                            <?php echo $rowPago['descripcion_tipopago'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group col-lg-12">
                                    <label for="txtCorreoElectronico">Adjuntar Archivo</label>
                                    <input type="file" name="archivo[]" value="" class="form-control file-input">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="txtDetalleventa">Detalle Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-border-color"></i></span>
                                        <textarea class="form-control" name="txtDetalleventa" id="txtDetalleventa" rows="3" style="width:100%;"  maxlength="500"></textarea>
                                    </div>
                                </div>
                                <br>
                                <button type="button" onclick="grabar()" class="btn btn-info btn-round"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>

<script type="text/javascript">
$('.form-control').maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "label label-success",
    limitReachedClass: "label label-danger",
    placement: 'bottom',
    separator: ' / '
});

//vlida el rut
$('input[name="txtRutUsuario"]').Rut({
    on_error: function() {
        $('button[type="submit"]').attr("disabled", true);
        $('button.btnlogin').html('Ops! Rut incorrecto');
    },
    format_on: 'keyup'
});

var errores = 0;

$('input[name="txtRutUsuario"]').Rut({
    on_error: function() {
        $('button[type="submit"]').attr("disabled", true);
        alertify.error('Run Incorrecto');
    },
    on_success: function() {
        $('button[type="submit"]').attr("disabled", false);
        alertify.success('Run Correcto');
    },
    format_on: 'keyup'
});

function grabar() {

    if (validacionesUsu() == '') {
        $.ajax({
            data: {
                "txtValorventa": $('#txtValorventa').val(),
                "txtFechaventa": $('#txtFechaventa').val(),
                "txtNombrecventa": $('#txtNombrecventa').val(),
                "txtDireccioventa": $('#txtDireccioventa').val(),
                "selTipopago": $('#selTipopago').val(),
                "txtDetalleventa": $('#txtDetalleventa').val(),
                "txtTelefonocliente": $('#txtTelefonocliente').val(),
                "txtCorreocliente": $('#txtCorreocliente').val()
            },
            url: "<?php echo $this->urlsave; ?>",
            type: "POST",
            cache: false,
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function() {
                $('.message').html(
                    '<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>'
                );
            },
            success: function(respuesta) {
                console.log(respuesta);
                if (respuesta == 1) {
                    alertify.success('Guardado Exitosamente!');
                    limpiar();
                } else {
                    alertify.error('Error al ingresar la información');
                }
            }
        });
        return false;
    } else {
        alertify.error(validacionesUsu());
    }

}

function validacionesUsu() {
    var errores = '';

    if ($('#txtValorventa').val() == '') {
        errores += '- Debe completar el Valor de la venta <br>';
    }
    if ($('#txtFechaventa').val() == '') {
        errores += '- Debe completar la Fecha de la venta <br>';
    }
    if ($('#txtNombrecventa').val() == '') {
        errores += '- Debe completar Nombre Cliente venta <br>';
    }
    if ($('#txtDireccioventa').val() == '') {
        errores += '- Debe completar la dirección de la venta <br>';
    }
    if ($('#selTipopago').val() == '') {
        errores += '- Debe completar el Tipo de pago <br>';
    }
    if ($('#txtDetalleventa').val() == '') {
        errores += '- Debe completar el detalle de la venta <br>';
    }

    return errores;
}

function limpiar() {
    $('#txtValorventa').val('');
    $('#txtFechaventa').val('');
    $('#txtNombrecventa').val('');
    $('#txtDireccioventa').val('');
    $('#selTipopago').val('');
    $('#txtDetalleventa').val('');
    $('#txtTelefonocliente').val('');
    $('#txtCorreocliente').val('');
}
</script>
